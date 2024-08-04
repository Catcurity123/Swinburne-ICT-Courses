# Function to calculate the area of a rectangle using the original formula
def rectangle_area_original(length, width):
    return length * width

# Mutant functions that introduce variations or errors to the original area calculation

def rectangle_area_mutant_1(length, width):
    # Returns the sum of length and width instead of their product
    return length + width

def rectangle_area_mutant_2(length, width):
    # Returns width multiplied by the square of length
    return width * length * length

def rectangle_area_mutant_3(length, width):
    # Returns the area with an additional 1 added
    return length * width + 1

def rectangle_area_mutant_4(length, width):
    # Returns the area with 1 subtracted
    return length * width - 1

def rectangle_area_mutant_5(length, width):
    # Returns the area as the square of the length
    return length * length

def rectangle_area_mutant_6(length, width):
    # Returns the area as the square of the width
    return width * width

def rectangle_area_mutant_7(length, width):
    # Returns the maximum of length and width, not the area
    return max(length, width)

def rectangle_area_mutant_8(length, width):
    # Returns the minimum of length and width, not the area
    return min(length, width)

def rectangle_area_mutant_9(length, width):
    # Returns half the area of the rectangle
    return (length * width) / 2

def rectangle_area_mutant_10(length, width):
    # Returns double the area of the rectangle
    return length * width * 2

def rectangle_area_mutant_11(length, width):
    # Returns the sum of length and width multiplied by the width
    return (length + width) * width

def rectangle_area_mutant_12(length, width):
    # Returns the area computed as length multiplied by the sum of width and length
    return length * (width + length)

def rectangle_area_mutant_13(length, width):
    # Returns the length multiplied by a constant 10
    return length * 10

def rectangle_area_mutant_14(length, width):
    # Returns the width multiplied by a constant 10
    return width * 10

def rectangle_area_mutant_15(length, width):
    # Returns the result of dividing length by width, not the area
    return length / width

def rectangle_area_mutant_16(length, width):
    # Returns the difference between length and width
    return length - width

def rectangle_area_mutant_17(length, width):
    # Returns the difference between width and length
    return width - length

def rectangle_area_mutant_18(length, width):
    # Returns the average of length and width
    return (length + width) / 2

def rectangle_area_mutant_19(length, width):
    # Returns the integer division of length by width
    return length // width

def rectangle_area_mutant_20(length, width):
    # Returns triple the area of the rectangle
    return length * width * 3

# Metamorphic Relations Tests

def test_addition_relation():
    # Test the effect of increasing both dimensions by a constant value
    constant = 3  # Constant to add
    test_cases = [
        (10, 10)  # Test case 2
    ]
    
    for case_id, (length, width) in enumerate(test_cases):
        # Calculate the area using the original function
        original_result = rectangle_area_original(length, width)
        
        # Increase both dimensions by the constant
        increased_length = length + constant
        increased_width = width + constant
        
        # Calculate the new area using the original function
        increased_result = rectangle_area_original(increased_length, increased_width)
        
        # Test each mutant function
        for i, mutant in enumerate([rectangle_area_mutant_1, rectangle_area_mutant_2, rectangle_area_mutant_3,
                                     rectangle_area_mutant_4, rectangle_area_mutant_5, rectangle_area_mutant_6,
                                     rectangle_area_mutant_7, rectangle_area_mutant_8, rectangle_area_mutant_9,
                                     rectangle_area_mutant_10, rectangle_area_mutant_11, rectangle_area_mutant_12,
                                     rectangle_area_mutant_13, rectangle_area_mutant_14, rectangle_area_mutant_15,
                                     rectangle_area_mutant_16, rectangle_area_mutant_17, rectangle_area_mutant_18,
                                     rectangle_area_mutant_19, rectangle_area_mutant_20], 1):
            # Calculate the area with the increased dimensions using the mutant function
            increased_mutant_result = mutant(increased_length, increased_width)
            
            # Check if the mutant result matches the expected increased result
            if increased_result == increased_mutant_result:
                print(f"Addition Relation Test case: {case_id + 1}, Length: {length}, Width: {width}, "
                      f"Follow-up value: {increased_result}, Mutant {i}: {increased_mutant_result}, Result: Survived")

def test_swapping_relation():
    # Test the effect of swapping length and width
    test_cases = [
        (10, 10)  # Test case 2
    ]
    
    for case_id, (length, width) in enumerate(test_cases):
        # Calculate the area using the original function
        original_result = rectangle_area_original(length, width)
        
        # Calculate the area by swapping length and width
        swapped_result = rectangle_area_original(width, length)
        
        # Test each mutant function
        for i, mutant in enumerate([rectangle_area_mutant_1, rectangle_area_mutant_2, rectangle_area_mutant_3,
                                     rectangle_area_mutant_4, rectangle_area_mutant_5, rectangle_area_mutant_6,
                                     rectangle_area_mutant_7, rectangle_area_mutant_8, rectangle_area_mutant_9,
                                     rectangle_area_mutant_10, rectangle_area_mutant_11, rectangle_area_mutant_12,
                                     rectangle_area_mutant_13, rectangle_area_mutant_14, rectangle_area_mutant_15,
                                     rectangle_area_mutant_16, rectangle_area_mutant_17, rectangle_area_mutant_18,
                                     rectangle_area_mutant_19, rectangle_area_mutant_20], 1):
            # Calculate the area by swapping dimensions using the mutant function
            swapped_mutant_result = mutant(width, length)
            
            # Check if the mutant result matches the expected swapped result
            if swapped_result == swapped_mutant_result:
                print(f"Swapping Relation Test case: {case_id + 1}, Length: {length}, Width: {width}, "
                      f"Follow-up value: {swapped_result}, Mutant {i}: {swapped_mutant_result}, Result: Survived")

def test_one_dimensional_increment_relation():
    # Test the effect of incrementing one dimension by a constant value
    constant = 1  # Constant to add
    test_cases = [
        (10, 10)  # Test case 2
    ]
    
    for case_id, (length, width) in enumerate(test_cases):
        # Calculate the area with incremented width using the original function
        incremented_result = rectangle_area_original(length, width + constant)
        
        # Test each mutant function
        for i, mutant in enumerate([rectangle_area_mutant_1, rectangle_area_mutant_2, rectangle_area_mutant_3,
                                     rectangle_area_mutant_4, rectangle_area_mutant_5, rectangle_area_mutant_6,
                                     rectangle_area_mutant_7, rectangle_area_mutant_8, rectangle_area_mutant_9,
                                     rectangle_area_mutant_10, rectangle_area_mutant_11, rectangle_area_mutant_12,
                                     rectangle_area_mutant_13, rectangle_area_mutant_14, rectangle_area_mutant_15,
                                     rectangle_area_mutant_16, rectangle_area_mutant_17, rectangle_area_mutant_18,
                                     rectangle_area_mutant_19, rectangle_area_mutant_20], 1):
            # Calculate the area with incremented width using the mutant function
            incremented_width_mutant_result = mutant(length, width + constant)
            
            # Check if the mutant result matches the expected incremented result
            if (incremented_width_mutant_result == incremented_result):
                print(f"One-Dimensional Increment Relation Test case: {case_id + 1}, Length: {length}, Width: {width}, "
                      f"Follow-up value: {incremented_result}, Mutant {i}: "
                      f"Width Incremented: {incremented_width_mutant_result}, Result: Survived")

# Run the tests when the script is executed directly
if __name__ == "__main__":
    print("Running Addition Relation Tests:")
    test_addition_relation()  # Run the tests for addition relation
    print("\nRunning Swapping Relation Tests:")
    test_swapping_relation()  # Run the tests for swapping relation
    print("\nRunning One-Dimensional Increment Relation Tests:")
    test_one_dimensional_increment_relation()  # Run the tests for one-dimensional increment relation
