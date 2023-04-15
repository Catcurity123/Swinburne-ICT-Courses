
def factorial(n)
  if n == 0
        1
    else
        n * factorial(n-1)
    end
end

def main
  
  if ARGV[0].to_i > 1
    puts factorial(ARGV[0].to_i)
  else
    puts("Incorrect argument - need a single argument with a value of 0 or more.\n")
  end
end

main()