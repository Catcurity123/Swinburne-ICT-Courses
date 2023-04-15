require 'rubygems'
require 'gosu'

TOP_COLOR = Gosu::Color.new(0xff_ffffff)
BOTTOM_COLOR = Gosu::Color.new(0xff_000000)
SCREEN_W = 2010
SCREEN_H = 1080
X_LOCATION = 1200	

module ZOrder
  BACKGROUND, PLAYER, UI = *0..2
end

module Genre
  POP, CLASSIC, JAZZ, ROCK = *1..4
end

GENRE_NAMES = ['Null', 'Pop', 'Classic', 'Jazz', 'Rock']

class ArtWork
	attr_accessor :bmp, :dim
	def initialize(file, leftX, topY)
		@bmp = Gosu::Image.new(file)
		@dim = Dimension.new(leftX, topY, leftX + @bmp.width(), topY + @bmp.height())
	end
end

class Album
	attr_accessor :title, :artist, :artwork, :tracks
	def initialize (title, artist, artwork, tracks)
		@title = title
		@artist = artist
		@artwork = artwork
		@tracks = tracks
	end
end

class Track
	attr_accessor :name, :location, :dim, :icondim
	def initialize(name, location, dim, icondim)
		@name = name
		@location = location
		@dim = dim
    @icondim = icondim
	end
end

class Playlist
	attr_accessor :name, :location, :dim
	def initialize(name, location, dim)
		@name = name
		@location = location
		@dim = dim
	end
end

class Dimension
	attr_accessor :leftX, :topY, :rightX, :bottomY
	def initialize(leftX, topY, rightX, bottomY)
		@leftX = leftX
		@topY = topY
		@rightX = rightX
		@bottomY = bottomY
	end
end

class MusicPlayerMain < Gosu::Window

	def initialize
	    super SCREEN_W, SCREEN_H
	    self.caption = "Music Player Program"
	    @track_font = Gosu::Font.new(30)
	    @albums = read_albums()
	    @album_playing = -1
	    @track_playing = -1
      @list_playing = -1
      @heart = Gosu::Image.new("images/heart.png")
      @playlist = []
      @index = 1
      @listindex = 1
	end

  def read_albums()
		a_file = File.new("input.txt", "r")
		count = a_file.gets.chomp.to_i
		albums = Array.new()

		i = 0
		while i < count
			album = read_album(a_file, i)
			albums << album
			i += 1
	  	end

		a_file.close()
		return albums
	end

  def read_album(a_file, idx)
		title = a_file.gets.chomp
		artist = a_file.gets.chomp
		if idx % 2 == 0
			leftX = 30
		else
			leftX = 450
		end

    if idx <= 1
			topY = 30 
		else
			topY = 190 * (1 * 2) + 30 + 20 * (1 * 2)
		end
		
		artwork = ArtWork.new(a_file.gets.chomp, leftX, topY)
		tracks = read_tracks(a_file)
		album = Album.new(title, artist, artwork, tracks)
		return album
	end

  def read_tracks(a_file)
		count = a_file.gets.chomp.to_i
		tracks = Array.new()
		i = 0
		while i < count
			track = read_track(a_file, i)
			tracks << track
			i += 1
		end
		return tracks
	end

  def read_track(a_file, idx)
    #Track info
		track_name = a_file.gets.chomp
		track_location = a_file.gets.chomp

		leftX = X_LOCATION
		topY = 70 * idx + 30
		rightX = leftX + @track_font.text_width(track_name)
		bottomY = topY + @track_font.height()
		dim = Dimension.new(leftX, topY, rightX, bottomY)
    #Icon info
    
    leftXi = leftX - 50
		topYi = topY + 3
		rightXi = leftXi + 30
		bottomYi = topYi + 27
    icondim = Dimension.new(leftXi, topYi, rightXi, bottomYi)
    #Track init
		track = Track.new(track_name, track_location, dim, icondim)
		return track
	end

  def update
		if @album_playing >= 0 && @song == nil
			@track_playing = 0
			playTrack(0, @albums[@album_playing])
		end
		
		if @album_playing >= 0 && @song != nil && (not @song.playing?)
			@track_playing = (@track_playing + 1) % @albums[@album_playing].tracks.length()
			playTrack(@track_playing, @albums[@album_playing])
		end
	end

  def playTrack(track, album)
		@song = Gosu::Song.new(album.tracks[track].location)
		@song.play(false)
	end

  def playlist(track)
    @song = Gosu::Song.new(track.location)
		@song.play(false)
    
	end

  def draw
    @track_font.draw("Click on the heart icon to add to playlist", 1100, 400, ZOrder::UI, 1.2, 1.2, Gosu::Color::YELLOW)
    @track_font.draw("PLAYLIST", 1100, 500, ZOrder::UI, 1.5, 1.5, Gosu::Color::YELLOW)
		draw_background()
		draw_albums(@albums)
		if @album_playing >= 0
			draw_tracks(@albums[@album_playing])
			draw_current_playing(@track_playing, @albums[@album_playing])
		end
    if @playlist.length >0
      #draw_playlist_current(@playlist[@list_playing].dim.leftX - 12, @playlist[@list_playing].dim.topY)
      for track in @playlist
        drawplaylist(track)
      end
    end
    
	end

  def draw_background()
		draw_quad(0,0, TOP_COLOR, 0, SCREEN_H, TOP_COLOR, SCREEN_W, 0, BOTTOM_COLOR, SCREEN_W, SCREEN_H, BOTTOM_COLOR, z = ZOrder::BACKGROUND)
	end

  def draw_albums(albums)
		albums.each do |album|
			album.artwork.bmp.draw(album.artwork.dim.leftX, album.artwork.dim.topY , z = ZOrder::PLAYER)
		end
	end

  def draw_tracks(album)
		album.tracks.each do |track|
			display_track(track)
		end
	end

  def display_track(track)
		@track_font.draw(track.name, X_LOCATION, track.dim.topY, ZOrder::PLAYER, 1.0, 1.0, Gosu::Color::BLACK)
    @heart.draw(track.icondim.leftX, track.icondim.topY)
	end

	def draw_current_playing(idx, album)
    draw_rect(album.tracks[idx].dim.leftX - 12, album.tracks[idx].dim.topY, 5, @track_font.height() + 2, Gosu::Color::BLACK, z = ZOrder::PLAYER)
	  #@heart.draw(album.tracks[idx].dim.leftX - 50, album.tracks[idx].dim.topY + 3)
    #@heart.draw(album.tracks[idx].icondim.leftXi, album.tracks[idx].icondim.topYi)
  end

  def draw_playlist_current(x,y)
    draw_rect(x, y, 5, @track_font.height() + 2, Gosu::Color::BLACK, z = ZOrder::PLAYER)
  end

  def drawplaylist(track)
    @track_font.draw(track.name, track.dim.leftX, track.dim.topY, ZOrder::PLAYER, 1.0, 1.0, Gosu::Color::BLACK)
  end

  def needs_cursor?; true; end

  def area_clicked(leftX, topY, rightX, bottomY)
		if mouse_x > leftX && mouse_x < rightX && mouse_y > topY && mouse_y < bottomY
			return true
		end
		return false
	end

  def button_down(id)
		case id
	    when Gosu::MsLeft
	    	if @album_playing >= 0
		    	for i in 0...@albums[@album_playing].tracks.length() 
			    	if area_clicked(@albums[@album_playing].tracks[i].dim.leftX, @albums[@album_playing].tracks[i].dim.topY, @albums[@album_playing].tracks[i].dim.rightX, @albums[@album_playing].tracks[i].dim.bottomY) 
			    		playTrack(i, @albums[@album_playing])
			    		@track_playing = i
			    		break
			    	end
			    end
			end

			for i in 0...@albums.length() 
				if area_clicked(@albums[i].artwork.dim.leftX, @albums[i].artwork.dim.topY, @albums[i].artwork.dim.rightX, @albums[i].artwork.dim.bottomY)
					@album_playing = i
          
					@song = nil
					break
				end
			end

      if @playlist.length >= 0
        for track in @playlist
          if area_clicked(track.dim.leftX, track.dim.topY, track.dim.rightX, track.dim.bottomY)
            playlist(track)
            @list_playing = i
            break
          end
        end
    end

      for i in 0...@albums[@album_playing].tracks.length()
				if area_clicked(@albums[@album_playing].tracks[i].icondim.leftX, @albums[@album_playing].tracks[i].icondim.topY, @albums[@album_playing].tracks[i].icondim.rightX, @albums[@album_playing].tracks[i].icondim.bottomY)
					@song.play(true)
          name = @albums[@album_playing].tracks[i].name
          location = @albums[@album_playing].tracks[i].location
          

          if @playlist.length() > 3
            
            if @index > 4
              @index = 1
              @listindex += 1
            end
            leftX = X_LOCATION - 300 + @listindex * 130
            topY = 600 + @index * 50
            @index += 1
            

          else
            leftX = X_LOCATION - 300
            topY = 600 + @index * 50
            @index += 1
          end
          rightX = leftX + @track_font.text_width(name)
		      bottomY = topY + @track_font.height()
          dim = Dimension.new(leftX, topY, rightX, bottomY)
          playlist = Playlist.new(name, location, dim)
          @playlist.append(playlist)
				end
			end

	    end
	end

end

MusicPlayerMain.new.show if __FILE__ == $0