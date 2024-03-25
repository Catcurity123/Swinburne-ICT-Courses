<?php

include_once "DB_Class.php";
include_once "Authentication_Class.php";
include_once "functions.php";
include_once "Account_Class.php";
include_once "Friend_Class.php";

if(!isset($_SESSION)){
    session_start();
}


function DestroySession(){
    if(!isset($_SESSION)){
        session_destroy();
    }
}

function sanitize_input($data)
{
    $data = trim($data); // remove all white space
    $data = stripslashes($data); // remove any backslashes
    $data = htmlspecialchars($data); // converts any special characters to HTML entity
    return $data;
}

?>