require 'date'

def get_age()
  puts("Enter your age in years: ")
  age_in_years = gets().to_i()
  return age_in_years
end

def get_string(text)
  puts(text)
  s = gets()
  return s
end
 

def print_year_born(name,age)
  year_born = Date.today.year -  age
  name1 = name
  puts("#{name1} you were born in: #{year_born}")
end

def main()
  promt = "Enter your name:"
  age = get_age()
  name = get_string(promt).chomp()
  print_year_born(name,age)
end

main()
