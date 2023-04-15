require 'rubygems'
require 'gosu'
require './bezier_curve'

# The screen has layers: Background, middle, top

module ZOrder
  BACKGROUND, MIDDLE, TOP = *0..2
end

class DemoWindow < Gosu::Window
    def initialize
        super(400, 400, false)
        self.caption = "Curves Example"
    end

    def needs_cursor?
        true
    end

    def draw
        draw_curve(150, 25, 150, 75, 100, 25, 200, 75, 2, Gosu::Color::YELLOW, 5)
        draw_curve(100, 25, 100, 75, 50, 25, 150, 75, 2, Gosu::Color::YELLOW, 5)
        draw_curve(200, 25, 200, 75, 150, 25, 250, 75, 2, Gosu::Color::YELLOW, 5)
        draw_curve(100, 100, 100, 150, 75, 100, 75, 150, 2, Gosu::Color::BLUE, 10)
        draw_curve(100, 100, 100, 150, 125, 100, 125, 150, 2, Gosu::Color::BLUE, 10)
        draw_curve(200, 100, 200, 150, 175, 100, 175, 150, 2, Gosu::Color::BLUE, 10)
        draw_curve(200, 100, 200, 150, 225, 100, 225, 150, 2, Gosu::Color::BLUE, 10)
        draw_curve(100, 200, 200, 200, 125, 250, 175, 250, 2, Gosu::Color::RED, 10) 
    end
end

DemoWindow.new.show