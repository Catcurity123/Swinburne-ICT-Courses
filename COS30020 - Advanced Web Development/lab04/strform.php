<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming Form - Lab 4</h1>
    <form action="" method="POST">
        <label for="strinput">Enter a word: </label>
        <input type="text" name="strinput" id="strinput">
        <input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
    </form>
</body>

<?php
    if (isset($_POST["strinput"])) {
        require 'strprocess.php';
    }
?>

</body>


</html>