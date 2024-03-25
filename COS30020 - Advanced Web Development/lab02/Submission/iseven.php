<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 2" />
    <meta name="keywords" content="Web,programming" />
    <title>Check Number</title>
</head>

<body>
    <!-- Form to get the number -->
    <!-- __FILE__ = http://localhost:3000/Test_Get.php || PHP_SELF = /Test_Get.php -->
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="number">Enter a number: </label>
        <input type="text" name="number" id="number">
        <input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
    </form>

    <!-- PHP code to check the number -->
    <?php
    //Check if the method is Get and if the input number exists
    $Predefined_Condition = $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['number']);


    //Requested logic
    if ($Predefined_Condition) {
        $number = $_GET['number']; //Get the number
        //Display string 
        $Even_Message = "The variable $number <strong>contains an even integer</strong>.";
        $Not_Even_Message = "The variable $number <strong>does not contain an even integer</strong>.";
        $Invalid_Message = "The input is not a valid number.";

        if (is_numeric($number)) {  //Check if the number is numeric
            $number = round($number); //Round the number down if it is float
            $message = $number % 2 == 0 ? $Even_Message : $Not_Even_Message; //Check if it is even
        } else {
            $message = $Invalid_Message;
        }
        echo $message;
    }
    ?>

</body>

</html>