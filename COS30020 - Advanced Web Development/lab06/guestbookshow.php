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
    <?php 
        $filename = "../../data/lab06/guestbook.txt";
        $dir = "../../data/lab06";
        
        if (file_exists($dir) && is_readable($filename)) {
            $handle = fopen($filename, "r");
            echo "<table border='1'>";
            echo "<thead><tr><th>Name</th><th>Email</th></tr></thead>";
            echo "<tbody>";
            while (!feof($handle)) {
                $onedata = fgets($handle);
                if ($onedata !== "") {
                    $data = explode(",", $onedata);
                    if (count($data) >= 2) {
                        echo "<tr><td>", $data[0], "</td><td>", $data[1], "</td></tr>";
                    }
                }
            }
            fclose($handle);
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "File is unreadable or does not exist";
        }
    ?>
</body>

</html>