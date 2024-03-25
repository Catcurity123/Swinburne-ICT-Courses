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
    <h1>Lab04 Task 3 - Standard Palindrome</h1>
    <form action="" method="POST">
        <label for="strinput">String: </label>
        <input type="text" name="strinput" id="strinput">
        <input type="submit" value="Check for Standard Palindrome">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
        <input type="button" value="Test Cases" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>?test=1'">
    </form>
</body>

<?php
    if (isset($_POST["strinput"])) {
        require 'standardpalindrome.php';
    }

    if (isset($_GET["test"]) && $_GET["test"] == 1) {
        require 'standardpalindrome.php';
    }
?>


</html>