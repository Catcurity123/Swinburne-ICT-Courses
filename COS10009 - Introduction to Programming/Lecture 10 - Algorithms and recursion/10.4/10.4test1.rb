require 'gosu'

module ZOrder
  BACKGROUND, MIDDLE, TOP = *0..2
end

MAP_WIDTH = 200
MAP_HEIGHT = 200
CELL_DIM = 20

class Cell
  attr_accessor :north, :south, :east, :west, :vacant, :visited, :on_path

  def initialize()
    @north = nil
    @south = nil
    @east = nil
    @west = nil
    @vacant = false
    @visited = false
    @on_path = false
  end
end

class GameWindow < Gosu::Window
  def initialize
    super MAP_WIDTH, MAP_HEIGHT, false    
    self.caption = "Map Creation"
    @path = nil
    @path2 = []

    x_cell_count = MAP_WIDTH / CELL_DIM
    y_cell_count = MAP_HEIGHT / CELL_DIM

    @columns = Array.new(x_cell_count)
    column_index = 0

    while (column_index < x_cell_count)
      row = Array.new(y_cell_count)
      @columns[column_index] = row
      row_index = 0
      while (row_index < y_cell_count)
        cell = Cell.new()
        @columns[column_index][row_index] = cell
        row_index += 1
      end
      column_index += 1
    end

    column_index = 0
    while (column_index < x_cell_count)
      row_index = 0
      while row_index < y_cell_count
        if column_index >= 0 && column_index < x_cell_count - 1
          @columns[column_index][row_index].east = @columns[column_index + 1][row_index]
        else
          @columns[column_index][row_index].east = nil
        end

        if column_index > 0 && column_index < x_cell_count
          @columns[column_index][row_index].west = @columns[column_index - 1][row_index]
        else
          @columns[column_index][row_index].west = nil
        end

        if row_index >= 0 && row_index < y_cell_count - 1
          @columns[column_index][row_index].south = @columns[column_index][row_index + 1]
        else
          @columns[column_index][row_index].south = nil
        end

        if row_index > 0 && row_index < y_cell_count
          @columns[column_index][row_index].north = @columns[column_index][row_index - 1]
        else
          @columns[column_index][row_index].north = nil
        end
        row_index += 1
      end
      column_index += 1
    end
  end

  def needs_cursor?
    true
  end

  def mouse_over_cell(mouse_x, mouse_y)
    if mouse_x <= CELL_DIM
      cell_x = 0
    else
      cell_x = (mouse_x / CELL_DIM).to_i
    end

    if mouse_y <= CELL_DIM
      cell_y = 0
    else
      cell_y = (mouse_y / CELL_DIM).to_i
    end

    [cell_x, cell_y]
  end

  def search(cell_x ,cell_y)

    dead_end = false
    path_found = false

    if (cell_x == ((MAP_WIDTH / CELL_DIM) - 1))
      puts "End of one path x: " + cell_x.to_s + " y: " + cell_y.to_s
      [[cell_x,cell_y]] 
    else
      north_path = nil
      west_path = nil
      east_path = nil
      south_path = nil

      puts "Searching. In cell x: " + cell_x.to_s + " y: " + cell_y.to_s

      if @columns[cell_x][cell_y].east != nil
        if @columns[cell_x][cell_y].east.vacant && !@columns[cell_x][cell_y].east.visited
          east_path = [cell_x+1,cell_y]
          @columns[cell_x][cell_y].visited = true
          @columns[cell_x][cell_y].on_path = true
        end
      end

      if east_path == nil
        if @columns[cell_x][cell_y].north != nil
          if (@columns[cell_x][cell_y].north.vacant) && !@columns[cell_x][cell_y].north.visited
            north_path = [cell_x,cell_y-1]
            @columns[cell_x][cell_y].visited = true
            @columns[cell_x][cell_y].on_path = true
          end
        end

        if @columns[cell_x][cell_y].south != nil
          if @columns[cell_x][cell_y].south.vacant && !@columns[cell_x][cell_y].south.visited
            south_path = [cell_x,cell_y+1]
            @columns[cell_x][cell_y].visited = true
            @columns[cell_x][cell_y].on_path = true
          end
        end

        if @columns[cell_x][cell_y].west != nil
          if @columns[cell_x][cell_y].west.vacant && !@columns[cell_x][cell_y].west.visited
            west_path = [cell_x-1,cell_y]
            @columns[cell_x][cell_y].visited = true
            @columns[cell_x][cell_y].on_path = true
          end
        end
        
      end

      if (north_path != nil)
        path = north_path
      elsif (south_path != nil)
        path = south_path
      elsif (east_path != nil)
        path = east_path
      elsif (west_path != nil)
        path = west_path
      end

      if (path != nil)
        puts "Added x: " + cell_x.to_s + " y: " + cell_y.to_s
        [[cell_x,cell_y]].concat(path)
        @path2 << path  
        search(path[0],path[1])                     
      else
        puts "Dead end x: " + cell_x.to_s + " y: " + cell_y.to_s
        nil 
      end
    end

  end

  def button_down(id)
    case id
      when Gosu::MsLeft
        cell = mouse_over_cell(mouse_x, mouse_y)
        puts("Cell clicked on is x: " + cell[0].to_s + " y: " + cell[1].to_s)
        @columns[cell[0]][cell[1]].vacant = true
      when Gosu::MsRight
        cell = mouse_over_cell(mouse_x, mouse_y)
        @path = search(cell[0],cell[1])
        @path2.prepend([cell[0],cell[1]])
        puts "Displaying path"
        puts @path2.to_s
      end
  end

  def walk(path)
      index = path.length
      count = 0
      while (count < index)
        cell = path[count]
        @columns[cell[0]][cell[1]].on_path = true
        count += 1
      end
  end

  def update
    if (@path != nil)
      walk(@path)
      @path = nil
    end
  end

  def draw
    index = 0
    x_loc = 0;
    y_loc = 0;

    x_cell_count = MAP_WIDTH / CELL_DIM
    y_cell_count = MAP_HEIGHT / CELL_DIM

    column_index = 0
    while (column_index < x_cell_count)
      row_index = 0
      while (row_index < y_cell_count)

        if (@columns[column_index][row_index].vacant)
          color = Gosu::Color::YELLOW
        else
          color = Gosu::Color::GREEN
        end
        if (@columns[column_index][row_index].on_path)
          color = Gosu::Color::RED
        end

        Gosu.draw_rect(column_index * CELL_DIM, row_index * CELL_DIM, CELL_DIM, CELL_DIM, color, ZOrder::TOP, mode=:default)

        row_index += 1
      end
      column_index += 1
    end
  end
end

window = GameWindow.new
window.show