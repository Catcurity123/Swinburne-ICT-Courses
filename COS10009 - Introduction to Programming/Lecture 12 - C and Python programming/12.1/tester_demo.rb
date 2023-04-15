require "minitest/autorun"
require_relative "student"

class StudentTest < Minitest::Test

  def test_student_id_is_integer
    assert_kind_of Integer, get_student_id(2)
  end

  def test_get_student_of_existing_id
    assert_equal ("Jill"), get_student_name_for_id(300)
  end

  def test_get_student_of_non_existing_id
    assert_equal ("Not Found"), get_student_name_for_id(800)
  end

  def test_get_student_name
    assert_equal ("Fred"), get_student_name(0)
  end

end