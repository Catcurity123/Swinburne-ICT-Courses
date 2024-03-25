<?php
include_once "Required.php";

$db = new DataBase();
$auth = new Authentication($db);
$auth->Logout();

if (!$auth->Authenticated()) {
    destroySession();
    header('Location: index.php');
} else {
    echo "Error logging out!";
}
?>