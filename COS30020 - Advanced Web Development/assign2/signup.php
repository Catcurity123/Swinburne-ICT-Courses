<?php
#Include required class
include_once "Required.php";
#Initialize Class
$db = new DataBase();
$auth = new Authentication($db);

if ($auth->Authenticated()) {
    header("Location: friendadd.php");
}

#Initialize Class
$db = new DataBase();
$auth = new Authentication($db);

#Initialize Variables
$email = "";
$profile_name = "";
$formPassword = "";
$confirm_password = "";

//Initialize arrays
$formErrors = array();
$procErrors = array();

//Store pre-entered value
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}
if (isset($_SESSION["profile_name"])) {
    $profile_name = $_SESSION["profile_name"];
}
if (isset($_SESSION["formErrors"])) {
    $formErrors = $_SESSION["formErrors"];
}


//Check if submitted
if (isset($_POST['submit'])) {
    //Check if all fields filled out
    if (isset($_POST['email']) && isset($_POST['profile_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        //Sanitize data
        $email = sanitize_input($_POST['email']);
        $profile_name = sanitize_input($_POST['profile_name']);
        $password = sanitize_input($_POST['password']);
        $confirm_password = sanitize_input($_POST['confirm_password']);

        //Validate email
        if (!empty($email)) {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $formErrors["email"] = "<p class=\"error_text\">Enter a valid email!</p>";
            }
        } else {
            $formErrors["email"] = "<p class=\"error_text\">Please enter an email!</p>";
        }

        //Validate profile_name
        if (!empty($profile_name)) {
            $profile_name = $profile_name;
            if (!preg_match("/^[a-zA-Z\s]{0,30}$/", $profile_name)) {
                $formErrors["profile_name"] = "<p class=\"error_text\">Enter a valid profile name (Can only contain 30 letters)!</p>";
            }
        } else {
            $formErrors["profile_name"] = "<p class=\"error_text\">Please enter a profile name!</p>";
        }

        //Validate Password
        if (!empty($password)) {
            $formPassword = $password;
            if (!preg_match("/^[a-zA-Z\d]{0,20}$/", $formPassword)) {
                $formErrors["password"] = "<p class=\"error_text\">Enter a valid password (Can only contain alphanumeric charaters)!</p>";
            }
        } else {
            $formErrors["password"] = "<p class=\"error_text\">Please enter password!</p>";
        }

        //Validate confirm_password
        if (!empty($confirm_password)) {
            $formConfPassword = $confirm_password;
            if ($formPassword != $formConfPassword) {
                $formErrors["confirm_password"] = "<p class=\"error_text\">Passwords do not match!</p>";
            }
        } else {
            $formErrors["confirm_password"] = "<p class=\"error_text\">Please enter confirm password!</p>";
        }

        //Check Unique email and register the account
        if (empty($formErrors)) {
            //Check Email Uniqueness
            if ($auth->CheckUnique($email)) {
                //Register the user
                $Registered = $auth->register($email, $profile_name, $password);
                //If the registration is successful then log the user in
                if ($Registered) {
                    echo "<p class=\"success_text\">Registered successfully!</p>";
                    $auth->Login($email, $formPassword);
                    //Redirect the user
                    if ($auth->Authenticated()) {
                        echo "<h1  class=\"success_text\">Account registered!</h1>";
                        echo "<p  class=\"success_text\">You will be shortly redirected.</p>";
                        $db->CloseConnection();
                        sleep(5);
                        header("Location: friendadd.php");
                    }
                } else {
                    $procErrors["Registration error"] = "<p class=\"error_text\">Registration failed!</p>";
                    $db->CloseConnection();
                }
            } else {
                $procErrors["Registration error"] = "<p class=\"error_text\">Email is already in use!</p>";
                $db->CloseConnection();
            }
        }
        #Stored entered credentials for display
        $_SESSION["errors"]["formErrors"] = $formErrors;
        $_SESSION["errors"]["procErrors"] = $procErrors;
    } else {
        echo "<p class=\"error_text\">You need to fill all the fields!</p>";
    }
}
if (isset($_POST['clear'])) {
    unset($_SESSION["email"]);
    unset($_SESSION["profile_name"]);
    unset($_SESSION["errors"]);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/signup.css" />
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <title>My Friend System | Assignment 2</title>
</head>

<body>
    <!-- Include Nav Bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.php')
        ?>
    </header>

    <header>
        <h2>Sign up page | My Friend System</h2>
    </header>

    <form action="signup.php" method="post">

        <div class="form-element">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="text" name="email" placeholder="" value="<?php echo $email; ?>" />
            <?php if (array_key_exists("email", $formErrors)) echo  $formErrors["email"]; ?>
        </div>

        <div class="form-element">
            <label for="profile_name">Profile Name</label>
            <input id="profile_name" class="form-control" type="text" name="profile_name" placeholder="" value="<?php echo $profile_name; ?>" />
            <?php if (array_key_exists("profile_name", $formErrors)) echo $formErrors["profile_name"]; ?>
        </div>

        <div class="form-element">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="" />
            <?php if (array_key_exists("password", $formErrors)) echo $formErrors["password"]; ?>
        </div>

        <div class="form-element">
            <label for="confirm_password">Confirm Password</label>
            <input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="" />
            <?php if (array_key_exists("confirm_password", $formErrors)) echo $formErrors["confirm_password"]; ?>
        </div>

        <button type="clear" name="clear">Clear</button>
        <input type="submit" value="Register" name="submit" />
    </form>

    <?php
    if ($procErrors) {
        echo '<div class="error-container">';
        foreach ($procErrors as $key => $value) {
            echo "<h1>$key</h1>";
            echo "<p>$value</p>";
        }
        echo '</div>';
    }
    ?>

</body>

</html>