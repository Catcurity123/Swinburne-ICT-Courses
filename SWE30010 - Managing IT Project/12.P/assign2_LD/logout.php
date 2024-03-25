<?php

	include_once "functions/general.php";

	//this file will destroy current session to allow current user logs out

	//destroy session
	function destroySession() {
		if (!isset($_SESSION)) {
			session_destroy();
		}
	}

	$db = new MyDatabase();
	$auth = new Authentication($db);
	$auth->logout();

	//if a user is logging in -> that user can log out
	if (!$auth->isAuth()) {
		destroySession();
		header("Location:login.php");
	}
	else {
		echo "Cannot log out";
	}
	
?>