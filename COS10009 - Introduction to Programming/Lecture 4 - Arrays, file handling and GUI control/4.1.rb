def write_data_to_file(file)
  file = File.new(file, "w")
  file.puts('5')
  file.puts('Fred')
  file.puts('Sam')
  file.puts('Jill')
  file.puts('Jenny')
  file.puts('Zorro')
  file.close()
end

def read_data_from_file(file)
  file = File.new(file, "r")
  count = file.gets.to_i
  i = 0
  while i < count do
     puts file.gets
    i += 1
  end
  file.close()
end

def main
  write_data_to_file("text.txt")
  read_data_from_file("text.txt")
end

main
