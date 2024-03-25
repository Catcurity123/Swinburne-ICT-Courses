<?php
$host = "feenix-mariadb.swin.edu.au";
$user = "s103802759"; // your user name
$pswd = "200802"; // your password d(date of birth – ddmmyy)
$dbnm = "s103802759_db"; // your database
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="STUID" />
    <title>setup</title>
</head>

<body>
    <h1>Setup form</h1>
    <form action="setup.php" method="post">
        <p>
            <?php
            echo "<label><input type=\"radio\" name=\"user\" value=\"$user\" required />Username</label>"
                . "<br>"
                . "<input type=\"radio\" name=\"pass\" value=\"$pswd\" required />Password</label>"
                . "<br>"
                . "<input type=\"radio\" name=\"db\" value=\"$dbnm\" required />Database</label>";

            ?>
            <br>

            <input type="submit" value="Set Up" />
        </p>
    </form>

    <?php
    if (isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["db"])) {
        // Create directory if required.

        if (!is_dir("../../data/lab10")) {
            umask(0007);
            $dir = "../../data/lab10";
            mkdir($dir, 02770);
        }

        $user = $_POST["user"];
        $pswd = $_POST["pass"];
        $dbnm = $_POST["db"];

        // Create .txt file 
        $filename = "../../data/lab10/mykeys.txt";
        umask(0007);
        $handle = fopen($filename, "w");
        $data = "<?php\n"
            . "\$host = '$host';\n"
            . "\$user = '$user';\n"
            . "\$pswd = '$pswd';\n"
            . "\$dbnm = '$dbnm';\n"
            . "?>\n";
        fputs($handle, $data);
        fclose($handle);
        echo "<p>Key file created</p>";

        if (!$filename) {    // check if file doesn't exist
            $error = "<span style='color:red'>Error: Cannot open file ($filename).</span>";
            echo $error;
            return;
        }
        
        // Connect to database.
        $user = $_POST["user"];
        $pswd = $_POST["pass"];
        $dbnm = $_POST["db"];
        $connection = @mysqli_connect($host, $user, $pswd)
            or die("Failed to connect to server");
        @mysqli_select_db($connection, $dbnm)
            or die("Database not available");

        $tableName = "hitcounter";
        $tableCheck = @mysqli_query($connection, "SHOW TABLES LIKE '$tableName'");
        if (mysqli_num_rows($tableCheck) == 0) {
            // Creates table if it does not exist
            $SQLString = "CREATE TABLE $tableName (
                id smallint PRIMARY KEY NOT NULL, 
                hits smallint NOT NULL
                )";
            $queryCreate = @mysqli_query($connection, $SQLString);
            // Check if table created
            if ($queryCreate === TRUE) {
                echo "<p> Table $tableName created successfully. </p>";
            } else {
                echo "<p> Error creating table: " . mysqli_error($connection) . "</p>";
            }
        }
        $addRecord = "INSERT INTO $tableName VALUES (1,0)";
        $queryResult = @mysqli_query($connection, $addRecord);
        if ($queryResult === FALSE) {
            echo "<p>Unable to add record</p>"
                . "<p>Error code " . mysqli_errno($connection)
                . ": " . mysqli_error($connection) . "</p>";
        } else {
            echo "<p>Record added</p>";
        }
    }

    ?>

<p><a href="./countvisits.php"> Count Visit </a></p></br>
</body>

</html>