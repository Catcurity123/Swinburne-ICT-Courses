<!DOCTYPE html>
<html>
<head>
<title>Guest Book</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
// validate input
if (empty($_GET['first_name']) || empty($_GET['last_name']))
	die("<p>You must enter your first and last name! Click your browser's Back button to return to the Guest Book form.</p>");

// select database
$DBConnect = @mysqli_connect("localhost", "root", "")
	Or die("<p>Unable to connect to the database server.</p>"
	. "<p>Error code " . mysqli_connect_errno()
	. ": " . mysqli_connect_error() . "</p>");

// create database if necessary
$DBName = "guestbook";
$SQLstring = "CREATE DATABASE IF NOT EXISTS $DBName";
$QueryResult = @mysqli_query($DBConnect, $SQLstring)
	Or die("<p>Unable to create the database.</p>"
	. "<p>Error code " . mysqli_errno($DBConnect)
	. ": " . mysqli_error($DBConnect) . "</p>");

// select the database
mysqli_select_db($DBConnect, $DBName);

// create table if necessary
$TableName = "visitors";
$SQLstring = "CREATE TABLE IF NOT EXISTS $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40), first_name VARCHAR(40))";
$QueryResult = @mysqli_query($DBConnect, $SQLstring)
	Or die("<p>Unable to create the table.</p>"
	. "<p>Error code " . mysqli_errno($DBConnect)
	. ": " . mysqli_error($DBConnect) . "</p>");

// sign
$LastName = mysqli_real_escape_string($DBConnect, $_GET['last_name']);
$FirstName = mysqli_real_escape_string($DBConnect, $_GET['first_name']);
$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";
$QueryResult = @mysqli_query($DBConnect, $SQLstring)
	Or die("<p>Unable to execute the query.</p>"
		. "<p>Error code " . mysqli_errno($DBConnect)
		. ": " . mysqli_error($DBConnect) . "</p>");
echo "<h1>Thank you for signing our guest book!</h1>";
mysqli_close($DBConnect);
?>
</body>
</html>