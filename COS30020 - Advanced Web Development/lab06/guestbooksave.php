<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <title>Lab 6</title>
</head>

<body>
    <h1>Lab 6 Task 2 - Guestbook</h1>
    <hr>
    <?php
    if (!is_dir('../../data/lab06')) {
        umask(0007);
        $dir = "../../data/lab06";
        mkdir($dir, 02770);
    }
    $filename = "../../data/lab06/guestbook.txt";

    function is_valid_email($email, $name, $filename) {
        if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
            $handle = fopen($filename, "r"); 
            while (!feof($handle)) {
                $onedata = fgets($handle);
                if ($onedata !== "") {
                    $data = explode(",", $onedata);
                    if(count($data) >= 2){
                        if ($data[0] === $name || $data[1] === $email) {
                            fclose($handle);
                            return false;
                        }
                    }
                }
            }
            fclose($handle);
            return true;
        } else {
            return false;
        }
    }

    if (isset($_POST["name"]) && isset($_POST["email"])) { 
        $name = $_POST["name"]; 
        $email = $_POST["email"]; 
        $filename = "../../data/lab06/guestbook.txt"; 
        umask(0007);
        $handle = fopen($filename, "a"); 
        if (is_writable($filename)) {
            if (is_valid_email($email, $name, $filename)) {
                $data = $name . "," . $email . "\n"; 
                fputs($handle, $data);
                echo "<p>Thanks for signing<p>";
            } else {
                echo "<p>You have already signed!</p>";
            }
        } else {
            echo "<p>The file is not writable!</p>";
        }
        fclose($handle);
    } else { 
        echo "<p>Please use the back button in your browser and fill out the form.</p>";
    }
    ?>
    <a href="guestbookshow.php">Show Guest Book</a>
    <a href="guestbookform.php">Return to form</a>
</body>

</html>