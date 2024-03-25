<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title> Display Members </title>
</head>

<body>
    <?php include('vip_members.php'); ?>
    <!-- PHP Script -->
    <?php
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
        die("<p><b> Error: </b> Table does not exist </p>");
    }


    // Query for displaying table
    $sqlDisplay = "SELECT member_id, fname, lname FROM $table_name";
    $queryDisplay = mysqli_query($conn, $sqlDisplay);


    // Create table
    echo "<table width='100%' border='1'>";
    echo "<tr class='bgcolor'>
                <th> Member ID </th>
                <th> First Name </th>
                <th> Last Name </th>
        </tr>";
    $row = mysqli_fetch_row($queryDisplay);
    echo "<p> Showing <b> " . mysqli_num_rows($queryDisplay) . " </b> row(s). </p>";
    while ($row) {
        echo "<tr>";
        echo "<td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "</tr>";
        $row = mysqli_fetch_row($queryDisplay);
    }
    mysqli_free_result($queryDisplay);
    mysqli_close($conn);
    ?>
</body>

</html>