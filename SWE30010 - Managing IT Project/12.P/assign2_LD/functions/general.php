<?php 
	if (!isset($_SESSION)) {
		session_start();
	}

	//include all necessary sub php files for the website
	include_once "dbsetup.php";
	include_once "authenticate.php";
	include_once "user.php";
?>