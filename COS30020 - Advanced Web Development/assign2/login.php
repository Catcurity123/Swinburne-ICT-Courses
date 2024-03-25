<?php
#Include required class
include_once "Required.php";

#Initialize Class
$db = new DataBase();
$auth = new Authentication($db);

if ($auth->Authenticated()) {
    header("Location: friendlist.php");
}

#Initialize variables
$email = "";
$password = "";
$formErrors = array();
$procErrors = array();

#Stored entered credentials
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}
if (isset($_SESSION["formErrors"])) {
    $formErrors = $_SESSION["formErrors"];
}

#Only proceed if the log in button is pressed
if (isset($_POST['submit'])) {
    //Check if all fields filled out
    if (isset($_POST['email'])  && isset($_POST['password'])) {
        //Sanitize data
        $email = sanitize_input($_POST['email']);
        $password = sanitize_input($_POST['password']);
    }

    //Validate email
    if (!empty($email)) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $formErrors["email"] = "<p class=\"error_text\">Enter a valid email!</p>";
        }
    } else {
        $formErrors["email"] = "<p class=\"error_text\">Please enter an email!</p>";
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

    #If there is no errors, then we will check the uniqueness of the email and log the user in
    if (empty($formErrors)) {
        if (!$auth->CheckUnique($email)) {
            $auth->Login($email, $password);
            if ($auth->Authenticated()) {
                $db->CloseConnection();
                header("Location: friendlist.php");
            } else {
                $procErrors["Cannot login"] = "<p class=\"error_text\">Make sure your email and password are correct!</p>";
                $db->CloseConnection();
            }
        } else {
            $procErrors["Login error"] = "<p class=\"error_text\">Account not found!</p>";
            $db->CloseConnection();
        }
    }

    #Stored entered credentials for display
    $_SESSION["errors"]["formErrors"] = $formErrors;
}

if (isset($_POST['clear'])) {
    unset($_SESSION["email"]);
    unset($_SESSION["errors"]);
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Friend System | Assignment 2</title>
    <link rel="stylesheet" type="text/css" href="./style/login.css" />
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
</head>

<body>
    <!-- Include Nav Bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.php')
        ?>
    </header>

    <header>
        <h2>Log in page | My Friend System</h2>
    </header>

    <form action="login.php" method="post">
        <div class="form-element">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="text" name="email" placeholder="" value="<?php echo $email; ?>" />
            <?php if (array_key_exists("email", $formErrors)) echo "<div class=\"error_text\">" . $formErrors["email"] . "</div>"; ?>
        </div>

        <div class="form-element">
            <label for="password">Password</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="" />
            <?php if (array_key_exists("password", $formErrors)) echo "<div class=\"error_text\">" . $formErrors["password"] . "</div>"; ?>
        </div>

        <button type="clear" class="outline float-right" name="clear">Clear</button>
        <input type="submit" value="Log in" name="submit" />
    </form>

    <?php
#Display Process error
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