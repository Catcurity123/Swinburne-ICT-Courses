require './input_function'
require 'colorize'

#0 - module and class
module Genre
  POP, CLASSIC, JAZZ, ROCK = *1..4
end

$genre_names = ['Pop', 'Classic', 'Jazz', 'Rock']

class Album
    attr_accessor :title, :artist, :genre, :tracks
    def initialize(title, artist, genre, tracks)
        @title = title
        @artist = artist
        @genre = genre
        @tracks = tracks
    end
end

class Track
    attr_accessor :name, :location
    def initialize(name, location)
        @name = name
        @location = location
    end
end


# 1 - read in album
def read_albums(music_file, albums)
  albums = Array.new()
  read_count = music_file.gets.to_i
  i = 0
  while i < read_count
    albums.push(read_album(music_file))
    i += 1
  end
  music_file.close()
  puts "#{read_count.to_s} albums read successffully".green
  read_string("Press enter to continue")
  return albums
end

def read_album(music_file)
  album_artist = music_file.gets.chomp
  album_title = music_file.gets.chomp
  album_genre = music_file.gets.chomp.to_i
  tracks = read_tracks(music_file)
	album = Album.new(album_title, album_artist, album_genre, tracks)
	return album
end

def read_track(music_file)
	name = music_file.gets
  location = music_file.gets
  track = Track.new(name,location)
  return track
end

def read_tracks(music_file)
	count = music_file.gets().to_i()
  tracks = Array.new()
  i = 0
  while i < count do
    tracks.push(read_track(music_file))
    i += 1
  end
	return tracks
end
#---------------------------------------------------------------------#

# Print albums
def print_albums(albums) 
  puts""
  count = albums.length
  i = 0
  while (i < count)
    puts "Information of album #{i + 1}".green
    print_album(albums[i])
    i += 1
  end
end

def print_album(album)
  puts("Artist is: " + album.artist)
  puts("Title is: " + album.title)
  puts('Genre is ' + album.genre.to_s)
  puts($genre_names[album.genre - 1])
  print_tracks(album.tracks)
  puts("")
end

def print_tracks(tracks)
  i = 0
  while i < tracks.length
    print_track(tracks[i])
    i += 1
  end
end

def print_track(track)
  puts(track.name)
  puts(track.location)
end
#---------------------------------------------------------------------#

# Display album by genre
def display_albums_by_genre(genre, albums)
  i = 0
  while i < albums.length 
    if albums[i].genre == genre
      puts "\nAlbum #{i + 1}"
      print_album(albums[i])
    end
    i += 1
  end
end
#---------------------------------------------------------------------#



#2 - print the album
def display_album(albums)
puts""
puts("DISPLAY ALBUM".green)

flag = true
while flag == true
  if true
    puts("")
    puts("1: Display All Album")
    puts("2: Display Genre")
    puts("3: Return")
    display_choice = read_integer_in_range("PlEASE SELECT AN OPTION (FROM 1 to 3)".green,1,3)

    while flag == true

      if display_choice == 1
        print_albums(albums)
        read_string("Press enter to continue")
        break
      end

      if display_choice == 2
        puts("SELECT GENRE")
        puts("1: Pop")
        puts("2: Classic")
        puts("3: Jazz")
        puts("4: Rock")
        puts("5: Return")
        genre_choice = read_integer_in_range("PlEASE SELECT AN OPTION (FROM 1 to 5)".green,1,5)

        display_albums_by_genre(genre_choice, albums)
        
        read_string("Press enter to continue")
        break
        
      end

      if display_choice == 3
        flag = false
        break
      end
    end
  end
end
end

#3 - play albums
def play_albums(albums)
  puts("")
  puts "Playing Albums".green
  i = 0
  count = albums.length
  while i < count 
    puts ("Album #{i + 1}: " + albums[i].title)
    i += 1
  end

  album_selection = read_integer_in_range("Select an album to play", 1, count)
  puts("Tracks in album #{album_selection}:".green)
  print_tracks(albums[album_selection - 1].tracks)
  while true
    if (albums[album_selection - 1].tracks.length) != 0
      track_selection = read_integer_in_range("Please select a track to play (from 1 to #{(albums[album_selection - 1].tracks.length)})".green, 1, (albums[album_selection - 1].tracks.length))
      puts ("Playing Track #{track_selection}: ".green + albums[album_selection - 1].tracks[track_selection - 1].name)
      sleep(5.0)
      puts("Song ended".blue)
      break
    else
      puts("There is nothing in this album".red)
      break
    end
  end
  read_string("Press enter to continue")
end

# 4 - update albums
def update_album(albums)
  flag = true
  while flag == true
    i = 0
    count = albums.length
    album_selection = modify_menu(albums)
    if album_selection == 5
      break
    end

    while flag == true
      if true
        puts("")
        puts("Title is: " + albums[album_selection - 1].title)
        puts("Genre is: " + $genre_names[albums[album_selection - 1].genre - 1])
        puts("1: Update title")
        puts("2: Update genre")
        puts("3: Return")
        modify_choice = read_integer_in_range("Please select an option(from 1 to 3)", 1, 3)

        while flag == true
          if modify_choice == 1
            albums[album_selection - 1].title = read_string("Please enter updated title: ")
            puts("Updated successfully".green)
            puts(albums[album_selection - 1].title)
            break
          end
          
          if modify_choice == 2
            updated_genre = read_string("Enter updated genre")
            case updated_genre.downcase
            when "pop"
              albums[album_selection - 1].genre = 1
              puts("Updated successfully".green)
              puts(albums[album_selection - 1].genre)
            when "classic"
              albums[album_selection - 1].genre = 2
              puts("Updated successfully".green)
              puts(albums[album_selection - 1].genre)
            when "jazz"
              albums[album_selection - 1].genre = 3
              puts("Updated successfully".green)
              puts(albums[album_selection - 1].genre)
            when "rock"
              albums[album_selection - 1].genre = 4
              puts("Updated successfully".green)
              puts(albums[album_selection - 1].genre)
            else
              read_string("Invalid genre please press enter to try again".red)
            end
            break
          end

          if modify_choice == 3
            flag = false
            break
          end
        end
        read_string("Press enter to continue")
      end
    end

  end
  return albums
end

def modify_menu(albums)
  puts("")
  puts "Modify menu".green
  i = 0
  count = albums.length
  while (i < count)
      puts("")
      puts "Albums #{i +1} Details: "
      puts ("Title is: " + albums[i].title)
      puts ("Genre is: " + $genre_names[albums[i].genre - 1])
      i += 1
  end
  
  puts("")
  i = 0
  while (i < count)
      puts "#{i + 1}: " + albums[i].title.chomp
      i += 1
  end
  puts("#{i + 1}: Exit Sub-Menu")
  album_selection = read_integer_in_range("Please select an album to modify (from 1 to #{i + 1})".green, 1, (i + 1))
  return album_selection
end

# 5 - rewrite album 
def write_data_to_file(albums)
  file = File.new("album.txt", "w")
  file.puts(albums.length.to_s)

  for i in 0...albums.length
    file.puts (albums[i].artist)
    file.puts (albums[i].title)
    file.puts (albums[i].genre.to_s)
    file.puts (albums[i].tracks.length)
    for j in 0...albums[i].tracks.length
      file.puts (albums[i].tracks[j].name)
      file.puts (albums[i].tracks[j].location)
    end
  end
end

# 6 - Main menu
def main_menu(albums)
  finished = false
  begin
    puts "  Main Menu: "
    puts "1 - Read in Album"
    puts "2 - Display Album Info"
    puts "3 - Play Album"
    puts "4 - Update Album"
    puts "5 - Exit"
  
    choice = read_integer_in_range("Option", 1, 5)

    case choice
    when 1
      file_name = read_string("PLease enter albums file name: ")
      music_file = File.new(file_name, "r+")
      albums = read_albums(music_file,albums)
    when 2
      if albums == nil 
        puts("")
        puts "Please enter albums information first".red
      else  
        display_album(albums)
      end
    when 3
      if albums == nil 
        puts("")
        puts "Please enter albums information first".red
      else  
        play_albums(albums)
      end
    when 4
      if albums == nil 
        puts("")
        puts "Please enter albums information first".red
      else  
        albums = update_album(albums)
      end
    when 5
      write_data_to_file(albums)
      puts("GOODBYE".red)
      finished = true
      break
    else  
      puts("Please select again")
    end 
  end until finished
end


#7 - Main
def main
  albums = nil
  main_menu(albums)
end
main()
