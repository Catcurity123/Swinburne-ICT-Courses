<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <title>Lab 6</title>
</head>
<body>
    <h1>Web Programming - Lab 6</h1>
    <?php
        if (!is_dir('../../data/lab06')) {
            umask(0007);
            $dir = "../../data/lab06";
            mkdir($dir, 02770);
        }
        $filename = "../../data/lab06/shop.txt";

    if (isset($_POST["item"]) && isset($_POST["quantity"])) {
        $item = $_POST["item"];
        $qty = $_POST["quantity"];
        $filename = "../../data/lab06/shop.txt";
        $alldata = array();
        if (is_writable($filename)) {
            $itemdata = array();
            $handle = fopen($filename, "r");
            while (!feof($handle)) {
                $onedata = fgets($handle);
                if ($onedata !== "") {
                    $data = explode(",", $onedata);
                    if (count($data) >= 2) { 
                        $alldata[] = $data;
                        $itemdata[] = $data[0];
                    }
                }
            }
            fclose($handle);
            $newdata = !(in_array($item, $itemdata));
        } else {
            $newdata = true;
        }
        if ($newdata) {
            $handle = fopen($filename, "a");
            $data = $item . "," . $qty . "\n";
            fputs($handle, $data);
            fclose($handle);
            $alldata[] = array($item, $qty);
            echo "<p>Shopping item added</p>";
        } else {
            echo "<p>Shopping item already exists</p>";
        }
        sort($alldata);
        echo "<table border='1'>";
        echo "<thead><tr><th>Item</th><th>Quantity</th></tr></thead>";
        echo "<tbody>";
        foreach ($alldata as $data) {
            echo "<tr><td>", $data[0], "</td><td>", $data[1], "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Please enter item and quantity in the input form.</p>";
    }
    ?>
</body>
</html>