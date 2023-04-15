STUDENTS = [
  [100,"Fred"],
  [200,"Sam"],
  [300,"Jill"],
  [400,"Jenny"]
]

# get the student id at the array index position
def get_student_id(array_index)
STUDENTS[array_index][0]
end

# get the student name at the array index position
def get_student_name(array_index)
STUDENTS[array_index][1]
end

# get the student name for the given student id (not array position)
def get_student_name_for_id(student_id)
count = 0
found = false
result = "Not Found"
while count < STUDENTS.length and !found
  if STUDENTS[count][0] == student_id
    found = true;
    result = STUDENTS[count][1]
  else
    count += 1
  end
end
result
end


def main()
puts get_student_id(0)
puts get_student_name(3)
puts get_student_name_for_id(300)
end

main()