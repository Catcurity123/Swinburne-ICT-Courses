def rectangle_area_original(length, width):
    return length * width

# Mutants
def rectangle_area_mutant_1(length, width):
    return length + width

def rectangle_area_mutant_2(length, width):
    return width * length

def rectangle_area_mutant_3(length, width):
    return length * width + 1

def rectangle_area_mutant_4(length, width):
    return length * width - 1

def rectangle_area_mutant_5(length, width):
    return length * length

def rectangle_area_mutant_6(length, width):
    return width * width

def rectangle_area_mutant_7(length, width):
    return max(length, width)

def rectangle_area_mutant_8(length, width):
    return min(length, width)

def rectangle_area_mutant_9(length, width):
    return (length * width) / 2

def rectangle_area_mutant_10(length, width):
    return length * width * 2

def rectangle_area_mutant_11(length, width):
    return (length + width) * width

def rectangle_area_mutant_12(length, width):
    return length * (width + length)

def rectangle_area_mutant_13(length, width):
    return length * 10

def rectangle_area_mutant_14(length, width):
    return width * 10

def rectangle_area_mutant_15(length, width):
    return length / width

def rectangle_area_mutant_16(length, width):
    return length - width

def rectangle_area_mutant_17(length, width):
    return width - length

def rectangle_area_mutant_18(length, width):
    return (length + width) / 2

def rectangle_area_mutant_19(length, width):
    return length // width

def rectangle_area_mutant_20(length, width):
    return length * width * 3

# Test cases
def test_mutants():
    test_cases = [
        (10, 10)
    ]
    
    mutants = [
        rectangle_area_mutant_1,
        rectangle_area_mutant_2,
        rectangle_area_mutant_3,
        rectangle_area_mutant_4,
        rectangle_area_mutant_5,
        rectangle_area_mutant_6,
        rectangle_area_mutant_7,
        rectangle_area_mutant_8,
        rectangle_area_mutant_9,
        rectangle_area_mutant_10,
        rectangle_area_mutant_11,
        rectangle_area_mutant_12,
        rectangle_area_mutant_13,
        rectangle_area_mutant_14,
        rectangle_area_mutant_15,
        rectangle_area_mutant_16,
        rectangle_area_mutant_17,
        rectangle_area_mutant_18,
        rectangle_area_mutant_19,
        rectangle_area_mutant_20
    ]
    
    for length, width in test_cases:
        original_result = rectangle_area_original(length, width)
        for i, mutant in enumerate(mutants, 1):
            mutant_result = mutant(length, width)
            result = "Survived" if original_result == mutant_result else "Killed"
            print(f"Length: {length}, Width: {width}, Original: {original_result}, Mutant {i}: {mutant_result}, Result: {result}")

if __name__ == "__main__":
    test_mutants()
