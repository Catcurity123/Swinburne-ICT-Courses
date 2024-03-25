<!DOCTYPE html>
<html>
<head>
<title>Passenger Train</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Passenger Train</h1><hr />
<?php
if (isset($_GET['distance']) && isset($_GET['stops'])) {
	if (is_numeric($_GET['distance']) && is_numeric($_GET['stops'])) {
		$Distance = $_GET['distance'];
		$Stops = $_GET['stops'];

		if ($_GET['weather'] == "good")
			$DurationTotalMinutes = ($Distance / 50) * 60;
		else
			$DurationTotalMinutes = ($Distance / 40) * 60;

		$DurationTotalMinutes += $Stops * 5;
		$DurationHours = (int) ($DurationTotalMinutes / 60);
		$DurationMinutes = $DurationTotalMinutes - ($DurationHours * 60);
		echo "<p>Based on the information you entered, your trip will take $DurationHours hours and $DurationMinutes minutes.</p>";
	} else {
		echo "<p>You must enter numeric values for distance and number of stops.</p>";
	}
} else {
	echo "<p>Enter the distance and number of stops and specify if the weather is good or bad.</p>";
}
?>
<form action="c03_PassengerTrain.php" method="get" enctype="application/x-www-form-urlencoded">
<p><input type="text" name="distance" value="<?php if (!empty($_GET['distance'])) echo $_GET['distance']; else echo 0; ?>" /> Distance (in miles)</p>
<p><input type="text" name="stops" value="<?php if (!empty($_GET['stops'])) echo $_GET['stops']; else echo 0; ?>" /> Number of Stops</p>
<p><input type="radio" name="weather" value="good" <?php if (empty($_GET['weather']) || $_GET['weather']=="good") echo 'checked="checked"'; ?> /> Weather is Good
<input type="radio" name="weather" value="bad" <?php if (!empty($_GET['weather']) && $_GET['weather']=="bad") echo 'checked="checked"'; ?> /> Weather is Bad</p>
<p><input type="submit" value="Calc Travel Time" /></p>
</form><hr />
</body>
</html>