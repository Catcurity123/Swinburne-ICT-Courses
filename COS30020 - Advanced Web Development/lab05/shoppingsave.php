<?php

if (!is_dir('../../data/lab05')) {
    umask(0007);
    $dir = "../../data/lab05";
    mkdir($dir, 02770);
}



function saveItem($item, $qty)
{
    if($item === "" || $qty ===""){
        return "Enter something first";
    }
    $filename = "../../data/lab05/shop.txt";
    //Append to file name
    $handle = fopen($filename, "w");
    if ($handle) {
        //Create data variable and ensure that EOL works for all machines
        $data = $item . "," . $qty . PHP_EOL;
        //Write the data to the file and close it
        fwrite($handle, $data);
        fclose($handle);
        return "You saved " . $item . " with the quantity of " . $qty;
    } else {
        return "Failed to open file.";
    }
}
//Additional feature to test for assignment 1 
function listItems()
{
    $filename = "../../data/lab05/shop.txt";
    if (file_exists("../../data/lab05/shop.txt")) {
        //List all item in the file as table
        $handle = fopen($filename, "r");
        echo "<table>";
        echo "<thead><tr><th>Item</th><th>Quantity</th></tr></thead>";
        echo "<tbody>";
        while (!feof($handle)) {
            $data = fgets($handle);
            $fields = explode(",", $data);
            if (count($fields) == 2) {
                echo "<tr><td>", $fields[0], "</td><td>", $fields[1], "</td></tr>";
            }
        }
        fclose($handle);
        echo "</tbody>";
        echo "</table>";
    }
    else{
        echo "<span style='color:red'>Add something first!</span>";
    }
}
