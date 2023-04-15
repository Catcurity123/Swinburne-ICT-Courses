

def print_silly_name(name):
    index = 0
    print(name + " is a")
    while (index < 60):
      print("silly", end =" ")
      index += 1
    print("name!")

def main():
    name = input("What is your name?\n")
    if(name == "Ted") or (name == "Fred"):
        print(name + "is an awesome name!")
    else:
        print_silly_name(name)

main()
