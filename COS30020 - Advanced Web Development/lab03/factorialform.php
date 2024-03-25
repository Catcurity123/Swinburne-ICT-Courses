<!DOCTYPE html>
<html lang="en" lang="en" >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 3" />
<meta name="keywords" content="Web,programming" />
<title>Using if and while statements</title>
</head>
<body>
<h1>Web Application Development - Lab 3</h1>

<form method="get" action="<?php echo './factorial.php' ?>">
        <label for="number">Enter a number: </label>
        <input type="text" name="number" id="number">
        <input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
</form>


</body>
</html>