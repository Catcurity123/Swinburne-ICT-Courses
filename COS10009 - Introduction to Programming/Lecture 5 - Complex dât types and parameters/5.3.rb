require 'rubygems'
require 'gosu'

module ZOrder
  BACKGROUND, MIDDLE, TOP = *0..2
end

WIN_WIDTH = 640
WIN_HEIGHT = 400

class DemoWindow < Gosu::Window

  def initialize
    super(WIN_WIDTH, WIN_HEIGHT, false)
    @background = Gosu::Color::WHITE
    @button_font = Gosu::Font.new(20)
    @info_font = Gosu::Font.new(10)
    @locs = [60,60]
  end

  def draw
    Gosu.draw_rect(0, 0, WIN_WIDTH, WIN_HEIGHT, @background, ZOrder::BACKGROUND, mode=:default)
    Gosu.draw_rect(260, 150, 100, 50, Gosu::Color::GREEN, ZOrder::TOP, mode=:default)
    if ((mouse_x > 260 and mouse_x < 370) and (mouse_y > 150 and mouse_y < 200))
      Gosu.draw_rect(259, 149, 102, 52, Gosu::Color::BLACK, ZOrder::MIDDLE, mode=:default)
    end
    @button_font.draw("Click me", 275, 165, ZOrder::TOP, 1.0, 1.0, Gosu::Color::BLACK)
    @info_font.draw("mouse_x: #{mouse_x}", 0, 350, ZOrder::TOP, 1.0, 1.0, Gosu::Color::BLACK)
    @info_font.draw("mouse_y: #{mouse_y}", 0, 360, ZOrder::TOP, 1.0, 1.0, Gosu::Color::BLACK)
  end

  def needs_cursor?; true; end

  def mouse_over_button(mouse_x, mouse_y)
    if ((mouse_x > 270 and mouse_x < 370) and (mouse_y > 150 and mouse_y < 200))
      true
    else
      false
    end
  end

  def button_down(id)
    case id
    when Gosu::MsLeft
      if mouse_over_button(mouse_x, mouse_y)
        @background = Gosu::Color::YELLOW
      else
        @background = Gosu::Color::WHITE
      end
    end
  end
end

DemoWindow.new.show