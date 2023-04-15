def write(aFile, number)
  aFile.puts(number)
  index = 0
  while (index < number)
   aFile.puts(index)
   index += 1
  end
end

def read(aFile)
  count = aFile.gets
  if (is_numeric?(count))
    count = count.to_i
  else
    count = 0
    puts "Error: first line of file is not a number"
  end

  index = 0
  while (index < count)
    line = aFile.gets
    puts "Line read: " + line.to_s
    index += 1
  end
end

def main
  aFile = File.new("mydata.txt", "w") 
  if aFile
    write(aFile, 10)   
  else
    puts "Unable to open file "  
  end
  aFile.close
  aFile = File.new("mydata.txt", "r") 
  if aFile
    read(aFile)
  else
    puts "Unable to read"  
  end
  aFile.close
end


def is_numeric?(obj)
  if /[^0-9]/.match(obj) == nil
    false
  end
  true
end

main