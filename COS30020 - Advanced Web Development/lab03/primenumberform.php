<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Using if and while statements</title>
</head>
<body>
    <h1>lab03 Task 3 - Prime Number</h1>

    <form method="get" action="">
        <label for="number">Enter a number: </label>
        <input type="text" name="number" id="number">
        <input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
    </form>

    <?php
    if (isset($_GET["number"])) {
        require 'primenumber.php';
    }
    ?>

</body>
</html>