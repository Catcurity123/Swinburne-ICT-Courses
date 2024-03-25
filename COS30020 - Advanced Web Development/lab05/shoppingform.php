<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming Form - Lab 5</h1>
    <!-- Form to receive user input -->
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="item">Item:</label>
        <input type="text" id="item" name="item"><br><br>
        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="qty"><br><br>
        <input type="submit" value="Add Item">
    </form>
    <!-- Additional button -->
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
        <input type="submit" name="test" value="List all item">
    </form>
</body>

<?php
require 'shoppingsave.php';

//Trigger saveItem function
if (isset($_POST["item"]) && isset($_POST["qty"])) {
    $message = saveItem($_POST["item"], $_POST["qty"]);
    echo "<p>$message</p>";
}

//Trigger listItems function
if (isset($_GET["test"])) {
    listItems();
}
?>

</html>