// ============================
// = User Input Function in C =
// ============================


#include <stdio.h>
#include "terminal_user_input.h"

//
// Reads a string of up to 255 characters + 1 for null
//
my_string read_string(const char* prompt)
{
  my_string result;     // declares a "my_string" variable (contains the array of character)
  printf("%s", prompt); // output the string from the prompt "%s" defines where to place the string in the output
  scanf(" %255[^\n]%*c", result.str ); // scan the input looking for upto 255 characters [ that are not newlines ], read this into the string variable
  return result; // return the my string value
}

//
// Reads a integer from the user.
//
int read_integer(const char* prompt)
{
  my_string line;
  int result;    // where we will store the result of the function
  char temp;  //used to check nothing comes after the int
  
  // Read in the string the user entered.
  line = read_string(prompt);

  // scan the string, looking for a number ... followed by nothing
  // sscanf = string scan format
  //          This will "scan" the array of character in line.str (reads this)
  //          " " = skip any spaces
  //          "%d" = read an integer
  //          " " = skip any spaces
  //          "%c" = read a character
  // sscanf returns the number of things it read (0 to 2 in this case)
  //          Loop while this is not equal to 1
  //          0 = did not read a number at the start
  //          1 = read a number, but no character followed it
  //          2 = read a number and a character... like "1 fred" (1 is the number, f is the character)
  while ( sscanf(line.str, " %d %c", &result, &temp) != 1 )
  {
    // scan found a number followed by something... so its not a whole number
    printf("Please enter a whole number.\n");

    // read the next "string" and try again
    line = read_string(prompt);
  }
  
  return result;
}

int read_integer_range(const char* prompt, int min, int max)
{
  int result = read_integer(prompt);
  while ( result < min || result > max )
  {
    printf("Please enter a number between %d and %d\n", min, max);
    result = read_integer(prompt);
  }
  return result;
}

double read_double(const char* prompt)
{
  my_string line;
  double result;    // where we will store the result of the function
  char temp;  //used to check nothing comes after the int
  
  // Read in the string the user entered.
  line = read_string(prompt);

  while ( sscanf(line.str, " %lf %c", &result, &temp) != 1 )
  {
    // scan found a number followed by something... so its not a whole number
    printf("Please enter a number.\n");

    // read the next "string" and try again
    line = read_string(prompt);
  }
  
  return result;
}

