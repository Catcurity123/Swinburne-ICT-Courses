def fibonacci(n):
    a, b = 0, 1
    for _ in range(n):
        a, b = b, a + b
    return a

if __name__ == "__main__":
    n = int(input("Enter a number to compute the nth Fibonacci number: "))
    print(f"The {n}th Fibonacci number is {fibonacci(n)}")