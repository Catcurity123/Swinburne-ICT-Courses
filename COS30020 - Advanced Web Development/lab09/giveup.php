<?php
session_start();
$_SESSION["correct_answer"] = $_SESSION["number"];
header("Location: guessinggame.php?gaveup=1");
exit();
?>