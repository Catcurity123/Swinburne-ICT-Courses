<?php

    include_once "functions/general.php";

    $db = new MyDatabase();
    $auth = new Authentication($db); 

    $email = "";
    $password = "";
    $error = array();
    $loginError = array();
    $registerError = array();
    $passwordPattern = "/^[a-zA-Z0-9]{6,20}$/";

    //create a session for Errors to prevent losing them
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
    }
    

    //* VALIDATE INPUTS *
    // Validate email
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
        if (isset($_POST['email']) && trim($_POST['email']) != '') {
            $email = trim($_POST['email']);
            //check email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {   
                $error['email'] = "Your email is invalid. Please enter it again.";
            }
        }
        else {
            $error['email'] = "Please enter an email.";
        }

        
        // Validate password
        if (isset($_POST['password']) && trim($_POST['password']) != '') {
            $password = htmlspecialchars(nl2br($_POST['password']));  //prevent line break, executing html tags
        }
        else {
            $error['password'] = "Please enter a password.";
        }

        // Check if the entered information matches any accounts in the database
        if (empty($error)) {
            if (!$auth->verifyUniqueEmail($email)) {
                $auth->login($email, $password);
                if ($auth->isAuth()) {
                    header("Location:info.php"); //success
                }
                else {
                    $loginError['Failed'] = "Your email or password is incorrect."; //failed
                }
            }
            else {
                $loginError['Not Found'] = "This email does not exist";
            }
        }

        $_SESSION['email'] = $email;
        $_SESSION['errors']['error'] = $error;
        $_SESSION['errors']['loginError'] = $loginError;
    }

    unset($_SESSION['email']);
    unset($_SESSION['errors']);

    //When RESET button is clicked
    if (isset($_POST['reset'])) {
        $email = "";
        $error['email'] = '';
        $error['password'] = '';
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
 <title>Assignment 2 | Log In</title>
</head>
<body>

    <style>
        <?php include 'style.css'; ?>
    </style>
    
    <!-- Header & Navigation Bar -->
    <?php include 'functions/header.php'; ?>

    <!-- Check if user has already signed in -->
    <?php
        if ($auth->isAuth()) {
            echo "<div id=\"messageSection\">";
            echo "<p id=\"message\">You have already signed in.<br>Please Log Out before using another account.</p>";
            echo "
            <div class=\"bottomLink\">
            <a href=\"logout.php\">LOG OUT</a>
            </div>
            ";
            exit();
        }
    ?>
    
    <!-- Body: Login Page-->
    <div class="registerForm"> 
        <div class="registerInfo">  <!-- the form -->
            <h1 class="registerTitle">LOG IN</h1>
            <img src="style/avatar1.jpg" alt="avatar" id="avatar">
            <form action ="login.php" method = "post" >
                <div class="registerContent">
                    <label>Email </label> <br>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form_input">
                    <br>
                    <?php 
                        //check if email has any errors
                        if (array_key_exists('email', $error)) {
                            if (!empty($error['email'])) {
                                echo "<div class=\"error\">".$error['email']."</div>";
                            }
                        }
                    ?>
                    <br>

                    <label>Password </label> <br>
                    <input type="password" name="password" class="form_input">
                    <br>
                    <?php 
                        //check if password has any errors
                        if (array_key_exists('password', $error)) {
                            if (!empty($error['password'])) {
                                echo "<div class=\"error\">".$error['password']."</div>";
                            }
                        }
                    ?>
                <?php
                    if (array_key_exists('Not Found', $loginError)) {
                        // This email does not exist
                        if (!empty($loginError['Not Found'])) {
                                echo "<div class=\"error\">".$loginError['Not Found']."</div>";
                        }
                    }
                    if (array_key_exists('Failed', $loginError)) {
                        // Your email or password is incorrect
                        if (!empty($loginError['Failed'])) {
                                echo "<div class=\"error\">".$loginError['Failed']."</div>";
                        }
                    }
                ?>
                <br>
                </div>
                
                <div class="formButton">
                    <input type="submit" name="submit" value="Log In" id="submitButton" name="submit">
                    <input type="submit" id="resetButton" value="Clear" name="reset">

                </div>

                <div class="formButton">
                    <a href="signup.php" id="link">New user? Register an account</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- <div class="bottomLink">
        <a href="index.php" id="homeButton">← BACK TO HOME</a>
    </div> -->
    
    
</body>
</html>