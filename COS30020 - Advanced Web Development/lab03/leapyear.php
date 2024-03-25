<?php

function is_leapyear($year){
    return $year % 4== 0 && ($year % 100 != 0 || $year % 400 == 0);
}

$year = $_GET["year"];
if ($year == null || !is_numeric($year) || $year < 0){
    $text = '<span style="color:red;">Please enter a valid year!</span>';
}
elseif (is_leapyear($year)) {
    $text = '<span style="color:green;">The year you entered '.$year.' is a leap year</span>';
}
else {
    $text = '<span style="color:red;">The year you entered '.$year.' is a standard year</span>';
}

echo $text;
?>