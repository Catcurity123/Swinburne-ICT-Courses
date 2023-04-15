require './input_functions'

def print_silly_name(name)
	puts(name + " is a")
	for i in 0...60 do
	  print("silly ")
  end
  puts("name!")
end

def main()
  name = read_string("What is your name?")
  print_silly_name(name)
end

main()
