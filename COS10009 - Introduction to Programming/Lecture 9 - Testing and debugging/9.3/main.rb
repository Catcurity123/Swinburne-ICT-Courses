require 'gosu'
require_relative 'player'
require_relative 'enemy'
require_relative 'constant'
require_relative 'bullet'
require_relative 'explosion'
require_relative 'credit'
#------------------------Initialize Section------------------------
class Game < Gosu::Window
  WIDTH = 800
  HEIGHT = 600
  def initialize
    super(WIDTH, HEIGHT)
    self.caption = 'Chicken Invader'
    @font = Gosu::Font.new(20)
    @start_music = Gosu::Song.new('sounds/Lost Frontier.ogg')
    @background_image = Gosu::Image.new('images/start_screen.png')
    @scene = :start
  end

  def initialize_game
    @scene = :game
    @counter = 0
    @chicken_count = Gosu::Font.new(self, Gosu::default_font_name, 50)
    #------------------------Player init------------------------
    @player = Player.new(self)
    #------------------------Enemy init------------------------
    xy_values = []
    CHICKENFRAME.times do |d|
      xy_values.push([100, 1 - d*100], [200, 1 - d*100], [300, 1 - d*100], [400, 1 - d*100], [500, 1 - d*100], [600, 1 - d*100], [700, 1 -d*100])
    end
    @enemy = []
    xy_values.each{|d| @enemy.push Enemy.new(self, d[0], d[1])}
    #------------------------Bullet init------------------------
    @bullets = []
    @shooting_sound = Gosu::Sample.new('sounds/shoot.ogg')
    #------------------------Explosion init------------------------
    @explosions = []
    @explosion_sound = Gosu::Sample.new('sounds/explosion.ogg')
    
  end

  def initialize_end(fate)
    @explosion_sound.play
    sleep(0.5)
    case fate
        when :count_reached
            @message = "The enemies have destroyed the base, you have failed."
        when :hit_by_enemy
            @message = "You were struck by an enemy ship."
            @message2 = "Before your ship was destroyed, "
            @message2 += "you took out #{@counter} enemy ships."
        when :off_top
            @message = "You got too close to the enemy mother ship."
            @message2 = "Before your ship was destroyed, "
            @message2 += "you took out #{@counter} enemy ships."
    end
    @bottom_message = "Press P to play again, or Q to quit."
    @message_font = Gosu::Font.new(28)
    @credits = []
    y = 700
    File.open('credits.txt').each do |line|
        @credits.push(Credit.new(self, line.chomp, 100, y))
        y+=30
    end
    @scene = :end
    @end_music = Gosu::Song.new('sounds/FromHere.ogg')
    @end_music.play(true)
  end
#----------------------------------------------------------------------

#------------------------Draw Section------------------------
  def draw
    case @scene
        when :start
            draw_start
        when :game
            draw_game
        when :end
            draw_end
    end
  end

  def draw_start
    @background_image.draw(0, 0, 0)
  end
  
  def draw_game
    @player.draw()
    @enemy.each {|chicken| chicken.draw}
    @bullets.each do |bullet|
      bullet.draw
    end
    @explosions.each do |explosion|
      explosion.draw
    end 
    @chicken_count.draw(@counter, 20 , 20, 1)
  end

  def draw_end
    clip_to(50,140,700,360) do
        @credits.each do |credit|
            credit.draw
        end
    end
    draw_line(0,140,Gosu::Color::RED,WIDTH,140,Gosu::Color::RED)
    @message_font.draw(@message,40,40,1,1,1,Gosu::Color::FUCHSIA)
    @message_font.draw(@message2,40,75,1,1,1,Gosu::Color::FUCHSIA)
    draw_line(0,500,Gosu::Color::RED,WIDTH,500,Gosu::Color::RED)
    @message_font.draw(@bottom_message,180,540,1,1,1,Gosu::Color::AQUA)
  end
#----------------------------------------------------------------------

#------------------------Update Section------------------------
  def update
    case @scene
        when :game
            update_game
        when :end
            update_end
    end
  end

  def update_game
    #------------------------Player------------------------
    if button_down?(Gosu::KbLeft)
      @player.turn_left
    end
    if button_down?(Gosu::KbRight)
      @player.turn_right
    end
    if button_down?(Gosu::KbUp)
      @player.accelerate
    end
    if button_down?(Gosu::KB_DOWN)
      @player.decelerate 
    end
    @player.move
    #------------------------Enemy------------------------
    @enemy.dup.each do |enemy|
      if enemy.y > HEIGHT + enemy.radius
          @enemy.delete enemy
      end
    end

    @enemy.each do |chicken| 
      chicken.move
    end
    #------------------------Bullet------------------------
    @bullets.dup.each do |bullet|
      @bullets.delete bullet unless bullet.onscreen?
    end
    
    @bullets.each do |bullet|
      bullet.move
    end
    #------------------------Explosion------------------------
    @explosions.dup.each do |explosion|
      @explosions.delete explosion if explosion.finished
    end
    #------------------------Bullet and enemy interaction------------------------
    @enemy.dup.each do |enemy|
      @bullets.dup.each do |bullet|
          distance = Gosu.distance(enemy.x, enemy.y, bullet.x, bullet.y)
          if distance < enemy.radius + bullet.radius
              @enemy.delete enemy
              @bullets.delete bullet
              @counter = @counter + 1
              @explosions.push Explosion.new(self, enemy.x, enemy.y)
              @explosion_sound.play
          end
        end
    end
    #------------------------Player and enemy interaction------------------------
    
    @enemy.each do |enemy|
      distance = Gosu.distance(enemy.x, enemy.y, @player.x, @player.y)
      initialize_end(:count_reached) if enemy.y > HEIGHT
      initialize_end(:hit_by_enemy) if distance < @player.radius + enemy.radius
    end
    initialize_end(:off_top) if @player.y < -@player.radius
  end

  def update_end
    @credits.each do |credit|
        credit.move
    end
    if @credits.last.y < 150
        @credits.each do |credit|  
            credit.reset
        end
    end
  end
#----------------------------------------------------------------------

#------------------------Button down Section------------------------
  def button_down(id)
    case @scene
        when :start
            button_down_start(id)
        when :game 
            button_down_game(id)
        when :end
            button_down_end(id)
    end
  end

  def button_down_start(id)
    initialize_game
  end

  def button_down_end(id)
    if id == Gosu::KbP
        initialize_game
    elsif id == Gosu::KbQ 
        close
    end
  end

  def button_down_game(id)
    if id == Gosu::KbSpace
      @bullets.push Bullet.new(self, @player.x , @player.y, @player.angle)
      @shooting_sound.play(0.3)
    end
  end
#----------------------------------------------------------------------

end


window = Game.new
window.show

