
class Enemy

  SPEED = 2

  attr_reader :x, :y, :radius
#--------------Initialize the position-------------------
  def initialize(window,x,y)
      @radius = 20
      @x = x
      @y = y
      @image = Gosu::Image.new('images/enemy.png')
  end
#--------------Move down -------------------
  

def move
      @y += SPEED
  end

  def draw
      @image.draw(@x - @radius , @y -@radius , 1)
  end

end