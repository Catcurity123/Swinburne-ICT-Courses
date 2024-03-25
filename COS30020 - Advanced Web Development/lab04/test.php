<?php
 if (isset ($_POST["___(1)___"])){ 
    $str = $_POST["___(2)___"]; 
    $pattern = "/^[A-Za-z ]+$/"; 
    if () { 
   $ans = ""; 
    $len = ; 
   for ($i = 0; $i < $len; $i++) { 
   $letter = substr ($str, (5), 1); 
   
   
    if ((strpos ("AEIOUaeiou", (6))) === false){ 
    $ans = $ans . $letter; 
    }
   }
   
    echo "<p>The word with no vowels is ", $ans, ".</p>";
    } else { 
   echo "<p>Please enter a string containing only letters or space.</p>";
    }
   } else { 
    echo "<p>Please enter string from the input form.</p>";
    }