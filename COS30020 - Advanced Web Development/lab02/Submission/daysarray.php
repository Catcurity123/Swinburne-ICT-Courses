<?php
//Days in English
$days = array(
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
);

//For loop to display the days in English
echo 'The days of the week in English are:'.'<br/>';
for ($i = 0; $i < count($days); $i++){
    $print = ($i < count($days) - 1) ? $days[$i] . ", " : $days[$i] . "."; 
    echo $print;
}

//Reassign value in days array
$days = array(
        'Dimanche',
        'Ludi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi'
);

//Create break lines
echo '<br/>';
echo '<br/>';

//For loop to display the days in French
echo 'The days of the week in French are:'.'<br/>';
for ($i = 0; $i < count($days); $i++){
    $print = ($i < count($days) - 1) ? $days[$i] . ", " : $days[$i] . "."; 
    echo $print;
}
?>