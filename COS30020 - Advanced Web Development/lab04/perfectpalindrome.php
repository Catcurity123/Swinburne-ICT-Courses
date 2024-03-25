<?php
function is_perfect_palindrome($str) {
        //Input validation
        if (!is_string($str) || strlen(trim($str)) < 2) {
            return '<span style="color:red;">The text you entered is invalid</span>';
        }

        $str = strtolower($str); // Convert to lowercase
        $str = preg_replace('/[^a-z]/', '', $str); // Remove non-letter characters

        $reverse = strrev($str);
        if($reverse != ''){
            $isPalindrome = strcmp($str, $reverse) == 0;
        }
        else{
            $isPalindrome = false;
        }
        
        $text = $isPalindrome
        ? '<span style="color:green;">The text you entered "' . $str . '" is a perfect palindrome</span>'
        : '<span style="color:red;">The text you entered "' . $str . '" is not a perfect palindrome</span>';

        return $text;
}

    if (isset($_POST["strinput"])) {
        $input = $_POST["strinput"];
        echo is_perfect_palindrome($input);
    }
    elseif (isset($_GET["test"]) && $_GET["test"] == 1) {
        $testCases = array(
            "A man, a plan, a canal, Panama!",
            "Hello, world!",
            "a",
            "12345",
            "Radar",
            "  racecar  ",
            "   "
        );
    
        foreach ($testCases as $str) {
            echo is_perfect_palindrome($str) . '<br>';
        }
    }
?>