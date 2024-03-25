<?php 

    include_once 'functions/general.php';

    $db = new MyDatabase();
    $auth = new Authentication($db);
    
    //refresh the page when deleting a friend
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
        if (isset($_POST['delete']) && $_POST['delete'] != '') {
            header("Location:info.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="description" content="Web application development" />
 <meta name="keywords" content="PHP" />
 <meta name="author" content="Linh Dan Nguyen" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="style.css">
 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
 <title>Assignment 2 | Patient Info</title>
</head>

<body>

    <style>
        <?php include 'style.css'; ?>
    </style>
    
    <!-- Header & Navigation Bar -->
    
    <?php include 'functions/header.php'; ?>
    
    <?php
        include_once "functions/general.php";

        if ($auth->isAuth()) {
            
            $session = $auth->authSessionSetup();
            $user = new User($db, $session['ID']);
        }

        if (!$auth->isAuth()) {
             echo "<div id=\"messageSection\">";
             echo "<p id=\"message\">Please Sign In</p>";
             echo "
             <div class=\"bottomLink\">
             <a href=\"login.php\">Sign In</a>
             </div>
             ";
             exit();
        }
    ?>

    <div class="InfoSection">
        <h1 class="registerTitle">Patient Information</h1>
        <div class="InfoContent">
            <div class="col1">
                <img src="style/avatar.jpg">
            </div>
            <div class="col2">
                <p><b>Patient Name:</b><?php echo " {$user->getUserProfile()}"?></p>
                <p><b>Email:</b><?php echo "  {$user->getUserEmail()}"?></p>
                <p><b>Year of Birth:</b> <?php echo "  {$user->getDateOfBirth()}"?></p>
                <p><b>Address: </b> <?php echo "  {$user->getUserAddress()}"?></p>
                <p><b>Insurance code: </b> <?php echo "  {$user->getUserInsuranceCode()}"?></p>
                <p><b>Joined date:</b><?php echo "  {$user->getCreatedDate()}"?></p>
            </div>
        </div>

        

        
    </div>

</body>