// ============================
// = User Input Function in C =
// ============================

//
// This header file contains the types and functions/procedures
// in the Terminal User Input code. You can #include "terminal_user_input.h"
// to access these from your project. Remember to compile both your
// program file and the terminal_user_input.c file.
//

//
// The following code makes sure that you cant accidentally
// include this code twice. It is common to see this kind of
// code at the top of a C/C++ header file.
//
#ifndef TERMINAL_USER_INPUT_H
#define TERMINAL_USER_INPUT_H

//
// The my_string type can be used to represent a "string" in C.
// This needs to be a struct so that it can be returned from
// functions.
//
typedef struct my_string
{
  char str[256]; // my string contains an array of 255 characters + null
} my_string;

//
// Reads a string of up to 255 characters + 1 for null
//
my_string read_string(const char* prompt);

//
// Reads a integer from the user.
//
int read_integer(const char* prompt);

//
// Reads a integer from the user in a given range.
//
int read_integer_range(const char* prompt, int min, int max);

//
// Reads a double from the user.
//
double read_double(const char* prompt);

#endif
