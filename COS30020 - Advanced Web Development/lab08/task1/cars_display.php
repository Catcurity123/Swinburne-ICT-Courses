<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title> Lab 8.1 </title>
    <style>
        td {
            text-align: center;
        }
        .bgcolor {
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <h1> Web Programming - Lab08 </h1>
    <?php
        require_once ("settings.php");
        // Connect to mysql server
        $conn = @mysqli_connect($host,$user,$pswd)
        or die("Failed to connect to server");
        // Use database
        @mysqli_select_db($conn, $dbnm)
        or die("Database not available");
        // Set up SQL string and execute
        $sqlCar = "SELECT car_id, make, model, price FROM cars";
        $results = mysqli_query($conn, $sqlCar);
        // Create table
        echo "<table width='100%' border='1'>";
        echo "<tr class='bgcolor'>
                <th> Car ID </th>
                <th> Make </th>
                <th> Model </th>
                <th> Price </th>
        </tr>";
        $row = mysqli_fetch_row($results);
        while ($row) {
            echo "<tr>";
            echo "<td>{$row[0]}</td>";
            echo "<td>{$row[1]}</td>";
            echo "<td>{$row[2]}</td>";
            echo "<td>{$row[3]}</td>";
            echo "</tr>";
            $row = mysqli_fetch_row($results);
        }
        mysqli_free_result($results);
        mysqli_close($conn);
    ?>
</body>
</html>