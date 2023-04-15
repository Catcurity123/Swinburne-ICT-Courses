class Player

  ROTATION_SPEED = 3
  ACCELERATION = 1
  FRICTION = 0.9

  attr_reader :x, :y, :angle, :radius

  def initialize(window)
      @x = 200
      @y = 200
      @angle = 0
      @image = Gosu::Image.new('images/ship.png')
      @velocity_x = 0
      @velocity_y = 0
      @radius = 20
      @window = window
  end
#--------------Turn direction-------------------
  def turn_right
      @angle += ROTATION_SPEED
  end

  def turn_left
      @angle -= ROTATION_SPEED
  end

  def accelerate
      @velocity_x += Gosu.offset_x(@angle, ACCELERATION) #----offset is used to change direction-------
      @velocity_y += Gosu.offset_y(@angle, ACCELERATION)
  end

  def decelerate
    @velocity_x -= Gosu.offset_x(@angle, ACCELERATION)
    @velocity_y -= Gosu.offset_y(@angle, ACCELERATION)
  end
#--------------Move and limit space-------------------
  def move
      @x += @velocity_x
      @y += @velocity_y
      @velocity_x *= FRICTION
      @velocity_y *= FRICTION

      if @x > @window.width - @radius
          @velocity_x = 0
          @x = @window.width - @radius - 15
      end

      if @x < @radius
          @velocity_x = 0
          @x = @radius 
      end

      if @y > @window.height - @radius
          @velocity_y = 0
          @y = @window.height - @radius - 15
      end
  end
#--------------draw-------------------
  def draw
      @image.draw_rot(@x, @y, 1, @angle)
  end
end