<?php
function is_prime($num){
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
       if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

$number = (int)$_GET["number"];
if ($number < 1 || $number > 999 || $number == null || !is_numeric($number)){
    $text = '<span style="color:red;">Please enter a number between 1 and 999!</span>';
}
elseif (is_prime($number)) {
    $text = '<span style="color:green;">The number you entered '.$number.' is a prime number!</span>';
} 
else {
    $text = '<span style="color:red;">The number you entered '.$number.' is not a prime number!</span>';
}
echo $text;
?>