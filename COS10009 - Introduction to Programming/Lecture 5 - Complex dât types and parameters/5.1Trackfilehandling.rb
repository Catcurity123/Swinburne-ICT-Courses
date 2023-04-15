class Track
	attr_accessor :name, :location

	def initialize (name, location)
		@name = name
		@location = location
	end
end

# read multiline from a file using array
def read_tracks(music_file)
  count = music_file.gets().to_i()
  tracks = Array.new()
  i = 0
  while (i < count)
    track = read_track(music_file)
    tracks.append(track)
    i += 1
  end
  return tracks
end

def read_track(a_file)
  name = a_file.gets()
  location = a_file.gets()
  track = Track.new(name,location)
  return track
end

# print multiline from an array
def print_tracks(tracks)
  index = 0
  while index < tracks.length
    print_track(tracks[index])
    index += 1
  end
end

def print_track(track)
  puts(track.name)
	puts(track.location)
end

def main()
  a_file = File.new("input.txt", "r")
  tracks = read_tracks(a_file)
  a_file.close()
  print_tracks(tracks)
end

main()
