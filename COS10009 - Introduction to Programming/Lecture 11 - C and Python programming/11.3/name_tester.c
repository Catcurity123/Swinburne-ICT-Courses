#include <stdio.h>
#include <string.h>
#include <stdbool.h>
#include "terminal_user_input.h"

#define LOOP_COUNT 60

void print_silly_name(my_string name)
{
  printf("Your name %s is a ", name.str);
  for(int i = 0; i < LOOP_COUNT; i++) {
    printf("silly ");
  }
  printf("name!\n");
}

int main()
{
  my_string name;
  name = read_string("What is your name? ");
  if (strcmp(name.str, "YOUR_TUTOR_NAME") == false)
  {
    printf("Your name is an awesome name!");  
  }else{
    print_silly_name(name);
  }
  return 0;
}