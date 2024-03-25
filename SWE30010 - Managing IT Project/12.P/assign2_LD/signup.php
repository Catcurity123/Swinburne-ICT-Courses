<?php
    include_once "functions/general.php";

    $db = new MyDatabase();
    $auth = new Authentication($db);

    $email = null;
    $profile = null;
    $password = null;
    $date_of_birth = null;
    $address = null;
    $insurance_code = null;
    $error = array();
    $registerError = array();
    $profilePattern = "/^[a-zA-Z ]{5,50}$/";
    $passwordPattern = "/^[a-zA-Z0-9]{6,20}$/";
    $yearofbirthPattern = "/^\d{4}$/";


    $errorMessage = "";
    $successMessage = "";

    //update current session values to their variables
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['profile'])) {
        $profile = $_SESSION['profile'];
    }
    if (isset($_SESSION['date_of_birth'])) {
        $date_of_birth = $_SESSION['date_of_birth'];
    }
    if (isset($_SESSION['address'])) {
        $address = $_SESSION['address'];
    }
    if (isset($_SESSION['insurance_code'])) {
        $insurance_code = $_SESSION['insurance_code'];
    }
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

        
        // Validate Profile Name (letters only length 5-50)
        if (isset($_POST['profile']) && trim($_POST['profile']) != '') {
            $profile = trim($_POST['profile']);
            
            if (!preg_match($profilePattern, $profile)) {
                if (strlen($profile) < 5 || strlen($profile) > 50) {
                    $error['profile'] = "Profile Name must have 5-50 characters.";
                }
                else {
                    $error['profile'] = "Profile name can only contain letters.";
                }
            }
        }
        else {
            $error['profile'] = "Please enter a profile name.";
        }

        
        // Validate Password (length 6-20)
        if (isset($_POST['password']) && trim($_POST['password']) != '') {
            $password = nl2br($_POST['password']);
            if (!preg_match($passwordPattern, $password)) {
                if (strlen($password) < 6 || strlen($password) > 20) {
                    $error['password'] = "Password must have 6-20 characters";
                }
                else {
                    $error['password'] = "Password can only contain letters and numbers.";
                }
                
            }
        }
        else {
            $error['password'] = "Please enter a password.";
        }

        
        // Validate Confirmed Password (length 6-20)
        if (isset($_POST['confirm']) && trim($_POST['confirm']) != '') {
            $confirm = htmlspecialchars(nl2br($_POST['confirm']));
            if ($password != $confirm) {
                $error['confirm'] = "The confirmed password does not match.";
            }
        }
        else {
            $error['confirm'] = "Please enter the confirmed password.";
        }

        // Validate year of birth
        if (isset($_POST['date_of_birth']) && trim($_POST['date_of_birth']) != '') {
            $date_of_birth = nl2br($_POST['date_of_birth']);
            if (!preg_match($yearofbirthPattern, $date_of_birth)) {
                if (strlen($date_of_birth) != 4) {
                    $error['date_of_birth'] = "Enter a valid year";
                }
                else {
                    $error['date_of_birth'] = "Enter a valid year";
                }
                
            }
        }
        else {
            $error['date_of_birth'] = "Please enter a year.";
        }

        // Validate address
        if (isset($_POST['address']) && trim($_POST['address']) != '') {
            $address = nl2br($_POST['address']);
            if (strlen($address) > 50) {
                $error['address'] = "Enter a valid address";
            }
        }
        else {
            $error['address'] = "Please enter a address.";
        }

        // Validate insurance code
        if (isset($_POST['insurance_code']) && trim($_POST['insurance_code']) != '') {
            $insurance_code = nl2br($_POST['insurance_code']);
            if (strlen($insurance_code) > 50) {
                $error['insurance_code'] = "Enter a valid insurance code";
            }
        }
        else {
            $error['insurance_code'] = "Please enter a insurance code.";
        }
        
        // if all inputs are OK -> create an account and login
        if (empty($error)) {
            if ($auth->verifyUniqueEmail($email)) {
                $isOK = $auth->signup($email, $profile, $password, $date_of_birth, $address, $insurance_code);

                if ($isOK) {
                    $auth->login($email, $password);
                    if ($auth->isAuth()) {
                        $successMessage .= "<p>Account registered!<p>";
                        $successMessage .= "<p>You will be shortly redirected.</p>";
                        header("Refresh: 2; url=info.php");
                    }
                }
                else {
                    $registerError['failed'] = "<p>Registration failed!</p>";
                }
            }
            else {
                $registerError['existed'] = "<p>The entered email already existed.</p>";
            }

            $_SESSION['email'] = $email;
            $_SESSION['profile'] = $profile;
            $_SESSION['password'] = $password;
            $_SESSION['date_of_birth'] = $date_of_birth;
            $_SESSION['address'] = $address;
            $_SESSION['insurance_code'] = $insurance_code;
            $_SESSION['error'] = $error;
            $_SESSION['registerError'] = $registerError;
        }

    }

    unset($_SESSION['email']);
    unset($_SESSION['profile']);
    unset($_SESSION['password']);
    unset($_SESSION['date_of_birth']);
    unset($_SESSION['address']);
    unset($_SESSION['insurance_code']);

    // store the registration status (Failed/Successful)
    if ($registerError) {
        foreach ($registerError as $key => $value) {
            $errorMessage .= "<p>$value</p>";
        }
    }

    //When RESET button is clicked
    if (isset($_POST['reset'])) {
        $email = "";
        $profile = "";
        $error['email'] = '';
        $error['profile'] = '';
        $error['password'] = '';
        $error['date_of_birth'] = '';
        $error['address'] = '';
        $error['insurance_code'] = '';
        $error['confirm'] = '';
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
 <title>Assignment 2 | Sign Up</title>
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
            echo "<p id=\"message\">You have already signed in.<br>Please Log Out before creating a new account.</p>";
            echo "
            <div class=\"bottomLink\">
            <a href=\"logout.php\">LOG OUT</a>
            </div>
            ";
            exit();
        }
    ?>

    

    <!-- Body: Sign up Page-->
    <div class="registerForm"> 
        <div class="registerInfo">  <!-- the form -->


            <h1 class="registerTitle">SIGN UP</h1>

            <?php 
                // display registration status
                if ($errorMessage != "") {
                    echo "<div class=\"registerFailed\">".$errorMessage."</div>";
                }
                if ($successMessage != "") {
                    echo "<div class=\"registerOK\">".$successMessage."</div>";
                }
            ?>
            
            <form action ="signup.php" method = "post" >
                <div class="registerContent">
                    <label>Email </label> <br>
                    <input type="text" name="email" value="<?php echo "$email"; ?>" class="form_input">
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

                    <label>Profile Name</label> <br>
                    <input type="text" name="profile" value="<?php echo "$profile"; ?>" class="form_input">
                    <br>
                    <?php 
                        //check if profile name has any errors
                        if (array_key_exists('profile', $error)) {
                            if (!empty($error['profile'])) {
                                echo "<div class=\"error\">".$error['profile']."</div>";
                            }
                        }
                    ?>
                    <br>

                    <label>Year of birth</label> <br>
                    <input type="text" name="date_of_birth" value="<?php echo "$date_of_birth"; ?>" class="form_input">
                    <br>
                    <?php 
                        //check if date_of_birth name has any errors
                        if (array_key_exists('date_of_birth', $error)) {
                            if (!empty($error['date_of_birth'])) {
                                echo "<div class=\"error\">".$error['date_of_birth']."</div>";
                            }
                        }
                    ?>
                    <br>

                    <label>Address</label> <br>
                    <input type="text" name="address" value="<?php echo "$address"; ?>" class="form_input">
                    <br>
                    <?php 
                        //check if address name has any errors
                        if (array_key_exists('address', $error)) {
                            if (!empty($error['address'])) {
                                echo "<div class=\"error\">".$error['address']."</div>";
                            }
                        }
                    ?>
                    <br>

                    <label>Insurance code</label> <br>
                    <input type="text" name="insurance_code" value="<?php echo "$insurance_code"; ?>" class="form_input">
                    <br>
                    <?php 
                        //check if insurance_code name has any errors
                        if (array_key_exists('insurance_code', $error)) {
                            if (!empty($error['insurance_code'])) {
                                echo "<div class=\"error\">".$error['insurance_code']."</div>";
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
                    <br>

                    <label>Confirm Password</label> <br>
                    <input type="password" name="confirm" class="form_input">
                    <br>
                    <?php 
                        //check if confirmed password has any errors
                        if (array_key_exists('confirm', $error)) {
                            if (!empty($error['confirm'])) {
                                echo "<div class=\"error\">".$error['confirm']."</div>";
                            }
                        }
                    ?>
                    <br>
                </div>
                
                <div class="formButton">
                    <input type="submit" name="submit" value="Sign Up" id="submitButton">
                    <input type="submit" name="reset" id="resetButton" value="Clear">
                </div>

                <div class="formButton">
                    <a href="login.php" id="link">Already had an account? Login</a>
                </div>
                
            </form>
        </div>
    </div>
    
  <!--   <div class="bottomLink">
        <a href="index.php" id="homeButton">← BACK TO HOME</a>
    </div> -->
    
</body>
</html>