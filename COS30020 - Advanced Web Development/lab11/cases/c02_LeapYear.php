<!DOCTYPE html>
<html>
<head>
<title>Leap Year</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
$Year = $_GET["year"];
if ($Year % 4 != 0)
    echo "The year you entered is a standard year.";
else if ($Year % 400 == 0)
    echo "The year you entered is a leap year.";
else if ($Year % 100 == 0)
    echo "The year you entered is a standard year.";
else
    echo "The year you entered is a leap year.";
?>
</body>
</html>