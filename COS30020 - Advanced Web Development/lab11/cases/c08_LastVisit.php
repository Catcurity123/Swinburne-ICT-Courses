<?php
if (isset($_COOKIE['lastVisit'])) {
	$LastVisit = "<p>Your last visit was on " . $_COOKIE['lastVisit'];
} else {
	$LastVisit = "<p>This is your first visit!</p>";
	setcookie("lastVisit", date("F j, Y, g:i a"), time()+60*60*24*365);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Last Visit</title>
<link rel="stylesheet" href="php_styles.css" type="text/css" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?= $LastVisit ?>
</body>
</html>