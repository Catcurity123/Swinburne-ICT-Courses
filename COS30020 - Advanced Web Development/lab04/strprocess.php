
<?php
if (isset($_POST["strinput"])) { // check if form data exists
    $str = $_POST["strinput"]; // obtain the form data
    $pattern = "/^[A-Za-z]+$/"; // set regular expression pattern
    if (preg_match($pattern, $str)) { // check if $str with regular expression
        $ans = ""; // initialise variable for the answer
        $len = strlen($str); // obtain length of string $str
        for ($i = 0; $i < $len; $i++) { // checks all characters in $str
            $letter = substr($str, $i, 1); // extract 1 char using substr 
            if ((strpos("AEIOUaeiou", $letter)) === false) { // check using strpos
                $ans = $ans . $letter; // concatenate letter to answer
            }
        }
        // generate answer afterall letters are checked
        echo "<p>The word with no vowels is ", $ans, ".</p>";
    } else { // string contains invalid characters
        echo "<p>Please enter a string containing only letters or spaces.</p>";
    }
} else { // no input
    echo "<p>Please enter string from the input form.</p>";
}
?>
