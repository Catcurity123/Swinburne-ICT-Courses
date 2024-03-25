
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Vi Luan Dang" />
    <title>Lab9</title>
</head>

<body>
    <h1>Guessing Game - Lab09</h1>
    <p>Enter a number between 1 and 100, then press the Guess button.</p>

    <?php
    session_start();

    $gaveup = isset($_GET["gaveup"]);

    if (isset($_GET["guess"]) && isset($_SESSION["number"])) {
        if ($_GET["guess"] === "") {
            echo '<span style="color: red">Enter a valid number</span>';
        } else if (!is_numeric($_GET["guess"])) {
            echo '<span style="color: red">Enter a valid number</span>';
        } else {
            $number = $_SESSION["number"];
            if ($number == $_GET["guess"]) {
                $count = $_SESSION["count"];
                echo '<span style="color: green">Correct! You got it in ' . $count . ' guess' . ($count != 1 ? 'es' : '') . '.</span>';
            } else {
                $_SESSION["count"]++;
                $count = $_SESSION["count"];
                echo '<span style="color: red">Guess #' . $count . ' was too ' . ($number < $_GET["guess"] ? 'high' : 'low') . ' - guess again!</span>';
            }
        }
    } else {
        $number = rand(1, 100);
        $_SESSION["number"] = $number;
        $_SESSION["count"] = 0;
    }

    if ($gaveup) {
        echo '<p style="color: orange">The correct answer was ' . $_SESSION["number"] . ' - you gave up!</p>';
        unset($_SESSION["correct_answer"]);
    }
    ?>

    <form action="guessinggame.php" method="get">
        <p>
            <input type="number" name="guess">
            <input type="submit" value="Guess" />
        </p>
    </form>

    <form action="giveup.php" method="post">
        <p>
            <input type="submit" value="Give Up" />
        </p>
    </form>

    <?php if (!$gaveup && isset($_SESSION["correct_answer"])) : ?>
        <p>The correct answer was <?php echo $_SESSION["correct_answer"]; ?>.</p>
    <?php unset($_SESSION["correct_answer"]);
    endif; ?>

    <p><a href="startover.php">Start Over</a></p>
</body>

</html>