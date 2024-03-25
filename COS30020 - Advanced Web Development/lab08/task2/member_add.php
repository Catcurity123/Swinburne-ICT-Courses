<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title> Add Members </title>
</head>

<body>
    <?php include('vip_members.php'); ?>
    <!-- PHP script -->
    <?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (empty($fname) || empty($lname) || empty($gender) || empty($email) || empty($phone)) {
        echo "<p> Please fill out all the fields. </p>";
        echo "<a href='./member_add_form.php'> 
                    <input class='button' type='submit' value='Add another member'>
            </a>";
    } else {
        require_once("settings.php");
        // Connect to mysql server
        $conn = @mysqli_connect($host, $user, $pswd)
            or die("Failed to connect to server");
        @mysqli_select_db($conn, $dbnm)
            or die("Database not available");
        $table_name = "vipmembers";


        // Check whether table exists
        $tableCheck = @mysqli_query($conn, "SHOW TABLES LIKE '$table_name'");
        if (mysqli_num_rows($tableCheck) == 0) {
            // Creates table if it does not exist
            $sqlCreateTable = "CREATE TABLE $table_name (
                    member_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    fname VARCHAR(40) NOT NULL,
                    lname VARCHAR(40) NOT NULL,
                    gender VARCHAR(1) NOT NULL,
                    email VARCHAR(40) NOT NULL,
                    phone VARCHAR(20) NOT NULL
                )";
            $queryCreate = @mysqli_query($conn, $sqlCreateTable);
            // Check if table created
            if ($queryCreate === TRUE) {
                echo "<p> Table $table_name created successfully. </p>";
            } else {
                echo "<p> Error creating table: " . mysqli_error($conn) . "</p>";
            }
        }


        // Insert data into database
        $sqlInsert = "INSERT INTO $table_name(fname, lname, gender, email, phone) VALUES
            ('$fname', '$lname', '$gender', '$email', '$phone')";
        $queryInsert = @mysqli_query($conn, $sqlInsert)
            or die("<p> Unable to execute the query.</p>"
                . "<p> Error code " . mysqli_errno($conn)
                . ": " . mysqli_error($conn) . "</p>");
        echo "<p> Successfully updated " . mysqli_affected_rows($conn) . " record(s). </p>";
        echo "<a href='./member_add_form.php'> 
                    <input class='button' type='submit' value='Add another member'>
            </a>";
        mysqli_close($conn);
    }
    ?>
</body>

</html>