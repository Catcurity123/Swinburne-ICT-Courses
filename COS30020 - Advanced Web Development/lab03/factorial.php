<!DOCTYPE html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 1" />
    <meta name="keywords" content="Web,programming" />
    <title>Using if and while statements</title>
</head>

<body>

    <?php
    include("mathfunctions.php");
    ?>
    <h1>Web Programming - Lab 3</h1>
    <?php
    if (isset($_GET["number"])) { // check if form data exists
        $num = $_GET["number"]; // obtain the form data
        if (is_numeric($num)) { // check if $num is a positive number
            if ($num == round($num)) { // check if $num is an integer
                echo "<p>", $num, "! is ", factorial($num), ".</p>";
            } else { // number is not an integer
                echo "<p>Please enter an integer.</p>";
            }
        } else { // number is not positive
            echo "<p>Please enter a positive integer. </p>";
        }
    } else { // no input
        echo "<p>Please enter a positive integer.</p>";
    }
    ?>
</body>

</html>