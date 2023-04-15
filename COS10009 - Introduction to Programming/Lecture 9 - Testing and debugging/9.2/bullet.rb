class Bullet
  attr_reader :x, :y
  
  def initialize(animation)
    @animation = animation
    @color = Gosu::Color::BLACK.dup
    @color.red = rand(256 - 40) + 40
    @color.green = rand(256 - 40) + 40
    @color.blue = rand(256 - 40) + 40
    @x = rand * 640
    @y = rand * 480
  end
  
  def draw
    img = @animation
    img.draw(@x - img.width / 2.0, @y - img.height / 2.0, ZOrder::BULLET, 1, 1, @color, :add)
  end
end