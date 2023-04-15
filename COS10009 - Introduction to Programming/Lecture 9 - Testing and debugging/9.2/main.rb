require 'gosu'
require_relative 'player'
require_relative 'bullet'

module ZOrder
  BACKGROUND, BULLET, PLAYER, UI = *0..3
end

class Game < Gosu::Window
  WIDTH = 800
  HEIGHT = 600
  def initialize
    super(WIDTH, HEIGHT)
    self.caption = 'Collecting bullet'
    @font = Gosu::Font.new(20)
    @start_music = Gosu::Song.new('sounds/Lost Frontier.ogg')
    @background_image = Gosu::Image.new('images/start_screen.png')
    @bullet_anim = Gosu::Image.new("images/bullet.png")
    @bullets = []
    @scene = :start
  end

  def initialize_game
    @scene = :game
    @player = Player.new(self)
    @game_music = Gosu::Song.new('sounds/Cephalopod.ogg')
    @game_music.play(true)
  end

  def draw
    case @scene
        when :start
            draw_start
        when :game
            draw_game
        end
  end
  
  def draw_start
    @background_image.draw(0, 0, 0)
  end

  def draw_game
    @player.draw()
    @bullets.each { |bullet| bullet.draw }
    @font.draw_text("Score: #{@player.score}", 10, 10, ZOrder::UI, 1.0, 1.0, Gosu::Color::YELLOW)
  end

  def update
    case @scene
        when :game
            update_game
        end
  end

  def update_game
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
    @player.collect_bullets(@bullets)

    if rand(100) < 4 and @bullets.size < 25
      @bullets.push(Bullet.new(@bullet_anim))
    end
  end

    def button_down(id)
      case @scene
          when :start
              button_down_start(id)
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
  end
  
window = Game.new
window.show