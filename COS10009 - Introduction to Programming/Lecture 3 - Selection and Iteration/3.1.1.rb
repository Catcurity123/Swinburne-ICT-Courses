require './input_functions'

def maintain_albums()
  finished = false
  begin
    puts('Maintain Albums Menu:')
    puts('1 To Update Album Title')
    puts('2 To Update Album Genre')
    puts('3 To Enter Album')
    puts('4 Exit')
    choice = read_integer_in_range("Please enter your choice:", 1, 4)
    case choice
    when 1
      read_string("You selected Update Album Title. Press enter to continue")
	  when 2
      read_string("You selected Update Album Genre. Press enter to continue")
    when 3
      read_string("You selected Enter Album. Press enter to continue")
    when 4
      finished = true
      break
    else
      puts('Please select again')
    end
  end until finished
end

# a stub for Main Menu Option 2: Play existing Album
def play_existing_album()
  puts("You selected Play Existing Album. Press enter to continue")
  gets()
end

# complete the case statement below and
# add a stub like the one above for option 2
# of this main menu
def main()
  finished = false
  begin
    puts('Main Menu:')
    puts('1 To Enter or Update Album')
    puts('2 To Play Existing Album')
    puts('3 Exit')
    choice = read_integer_in_range("Please enter your choice:", 1, 3)
    case choice
    when 1
      maintain_albums()
	  when 2
      play_existing_album()
    when 3
      finished = true
      break
    else
      puts('Please select again')
    end
  end until finished
end
	


main()
