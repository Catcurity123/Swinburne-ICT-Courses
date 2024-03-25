<?php include 'functions/general.php';?>
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
</head>
<body>
    
    
    <style>
        <?php include 'style.css'; ?>
    </style>
    
    <!-- Header & Navigation Bar -->
    <?php include 'functions/header.php'; ?>
    
    <!-- Body: Index - My Information -->
    <h1 class="heading">- On every step of your health journey -</h1>
    
    <div class="">
        <div class="textinfo">
            <?php
                $mydb = new MyDatabase();

                
                if ($mydb->init()) {
                }
                else {
                    echo "<p>Sorry, there were some problems when setting up your Database.</p>";
                }
            ?>
        </div>
    </div>
    
    <!-- Bottom Link -->
    <div class="bottomLink">
        <a href="signup.php">SIGN UP</a>
        <a href="info.php" id="middle_button">Patient Info</a>
        <a href="login.php">LOG IN</a>
    </div>
</body>
</html>