<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title> Search Members </title>
</head>

<body>
    <?php include('vip_members.php'); ?>
    <br>
    <div class="box2">
        <form action="./member_search.php" method="get">
            <p><label for="lname"><b> Last Name: </b></label>
                <input type="text" name="lname" id="lname">
            </p>

            <p><input type="submit" name="submit"></p>
        </form>
    </div>

    <!-- PHP Script -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $lnameSearch = isset($_GET["lname"]) ? $_GET["lname"] : false;

        if (empty($lnameSearch)) {
            echo "<br><div> Please fill in Last Name. </div><br>";
            die();
        }
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pswd)
            or die("Failed to connect to server");
        // Use database
        @mysqli_select_db($conn, $dbnm)
            or die("Database not available");
        $table_name = "vipmembers";


        // Check whether table exists
        $tableCheck = @mysqli_query($conn, "SHOW TABLES LIKE '$table_name'");
        if (mysqli_num_rows($tableCheck) == 0) {
            die("<p><b> Error: </b> Table does not exist </p>");
        }
        $sqlSearchDisplay = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname = '$lnameSearch'";
        $querySearchDisplay = mysqli_query($conn, $sqlSearchDisplay);


        // Create table
        echo "<table width='100%' border='1'>";
        echo "<tr class='bgcolor'>
                    <th> Member ID </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Email </th>
            </tr>";
        $row = mysqli_fetch_row($querySearchDisplay);
        echo "<p> Showing <b> " . mysqli_num_rows($querySearchDisplay) . " </b> result(s) for query: \"" . $lnameSearch . "\".</p>";
        while ($row) {
            echo "<tr>";
            echo "<td>{$row[0]}</td>";
            echo "<td>{$row[1]}</td>";
            echo "<td>{$row[2]}</td>";
            echo "<td>{$row[3]}</td>";
            echo "</tr>";
            $row = mysqli_fetch_row($querySearchDisplay);
        }
        mysqli_free_result($querySearchDisplay);
        mysqli_close($conn);
    }
    ?>
</body>

</html>