<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Programming :: Lab 2" />
<meta name="keywords" content="Web,programming" />
<title>Check Number</title>
</head>

<body>
    
	<form method="post">
		<label for="number">Enter a number:</label>
		<input type="text" name="number" id="number">
		<input type="submit" value="Check">
        <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
	</form>

    <?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$number = $_POST['number'];
		if (is_numeric($number)) {
			$number = floor($number);
			if ($number % 2 == 0) {
				echo "The number $number is an even integer.";
			} else {
				echo "The number $number is not an even integer.";
			}
		} else {
			echo "The input is not a valid number.";
		}
	}
	?>
</body>

</html>

