<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Using if and while statements</title>
</head>
<body>
    <h1>lab03 Task 2 - Leap year</h1>

    <form method="get" action="">
        <label for="year">Enter a year: </label>
        <input type="text" name="year" id="year">
        <input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
    </form>

    <?php
    if (isset($_GET["year"])) {
        require 'leapyear.php';
    }
    ?>

</body>
</html>