require 'rubygems'
require 'gosu'

TOP_COLOR = Gosu::Color.new(0xff_ffffff)
BOTTOM_COLOR = Gosu::Color.new(0xff_000000)
SCREEN_W = 1920
SCREEN_H = 1080
X_LOCATION = 1000

module ZOrder
  BACKGROUND, PLAYER, UI = *0..2
end

module Genre
  POP, CLASSIC, JAZZ, ROCK = *1..4
end

GENRE_NAMES = ['Null', 'Pop', 'Classic', 'Jazz', 'Rock']

class ArtWork
	attr_accessor :bmp
	def initialize(file)
		@bmp = Gosu::Image.new(file)
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
	attr_accessor :name, :location, :dimen
	def initialize(name, location, dimen)
		@name = name
		@location = location
		@dimen = dimen
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
	  @track_font = Gosu::Font.new(60)
    @track_playing = 0
	  @album = read_album()
		playTrack(@track_playing, @album)
	end


	def read_track(music_file, index)
		track_name = music_file.gets.chomp
		track_location = music_file.gets.chomp
		leftX = X_LOCATION
		topY = 100 * index + 300
		rightX = leftX + @track_font.text_width(track_name)
		bottomY = topY + @track_font.height()
		dimen = Dimension.new(leftX, topY, rightX, bottomY)
		track = Track.new(track_name, track_location, dimen)
		return track
	end


	def read_tracks(music_file)
		count = music_file.gets.chomp.to_i
		tracks = []
		i = 0
		while i < count
			track = read_track(music_file, i)
			tracks << track
			i += 1
		end
		return tracks
	end


	def read_album()
		music_file = File.new("input.txt", "r")
		title = music_file.gets.chomp
		artist = music_file.gets.chomp
		artwork = ArtWork.new(music_file.gets.chomp)
		tracks = read_tracks(music_file)
		album = Album.new(title, artist, artwork.bmp, tracks)
		music_file.close()
		return album
	end

	def draw_albums(albums)
		@album.artwork.draw(400, 300 , z = ZOrder::PLAYER, 1, 1)
		@album.tracks.each do |track|
			display_track(track)
		end
	end

	def draw_current_playing(index)
		draw_rect(@album.tracks[index].dimen.leftX - 10, @album.tracks[index].dimen.topY, 5, @track_font.height(), Gosu::Color::BLACK, z = ZOrder::PLAYER)
    draw_rect(@album.tracks[index].dimen.leftX - 10,@album.tracks[index].dimen.topY,@track_font.text_width(@album.tracks[index].name) + 10,5,Gosu::Color::BLACK, z = ZOrder::PLAYER)
	  draw_rect(@album.tracks[index].dimen.rightX , @album.tracks[index].dimen.bottomY - @track_font.height(), 5, @track_font.height(), Gosu::Color::BLACK, z = ZOrder::PLAYER)
    draw_rect(@album.tracks[index].dimen.leftX - 10,@album.tracks[index].dimen.topY + @track_font.height() - 5,@track_font.text_width(@album.tracks[index].name) + 10,5,Gosu::Color::BLACK, z = ZOrder::PLAYER)
  end


	def area_clicked(leftX, topY, rightX, bottomY)
		if mouse_x > leftX && mouse_x < rightX && mouse_y > topY && mouse_y < bottomY
			return true
		end
		return false
	end


	def display_track(track)
		@track_font.draw(track.name, X_LOCATION, track.dimen.topY, ZOrder::PLAYER, 1.0, 1.0, Gosu::Color::WHITE)
	end

	def playTrack(track, album)
		@song = Gosu::Song.new(album.tracks[track].location)
		@song.play(false)
	end

	def draw_background()
		draw_quad(0,0, TOP_COLOR, 0, SCREEN_H, TOP_COLOR, SCREEN_W, 0, BOTTOM_COLOR, SCREEN_W, SCREEN_H, BOTTOM_COLOR, z = ZOrder::BACKGROUND)
	end

	def update
		if not @song.playing?
			@track_playing = (@track_playing + 1) % @album.tracks.length()
			playTrack(@track_playing, @album)
		end
	end

	def draw
		draw_background()
		draw_albums(@album)
		draw_current_playing(@track_playing)
	end

 	def needs_cursor?; true; end


	def button_down(id)
		case id
	    when Gosu::MsLeft
	    	for i in 0...@album.tracks.length() 
		    	if area_clicked(@album.tracks[i].dimen.leftX, @album.tracks[i].dimen.topY, @album.tracks[i].dimen.rightX, @album.tracks[i].dimen.bottomY)
		    		playTrack(i, @album)
		    		@track_playing = i
		    		break
		    	end
		    end
	    end
	end

end


MusicPlayerMain.new.show if __FILE__ == $0

