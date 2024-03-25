<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Guestbook Form</title>
</head>

<body>
    <h1>Guestbook Form</h1>

    <?php
    $filename = "../../data/lab05/guestbook.txt";
    $contents = readGuestbookEntries($filename);
    echo "<pre>$contents</pre>";

    function readGuestbookEntries($filename)
    {
        $contents = "<table>\n<thead>\n<tr><th>First Name</th><th>Last Name</th></tr>\n</thead>\n<tbody>\n";

        // Check if the file is readable
        if (is_readable($filename)) {
            // Open the file for reading
            $file = fopen($filename, "r");
            if ($file) {
                // Read the file line by line and unescape any special characters
                while (($line = fgets($file)) !== false) {
                    $name_parts = explode(" ", stripslashes($line));
                    $contents .= "<tr><td style='padding-right: 10px'>" . $name_parts[0] . "</td><td>" . $name_parts[1] . "</td></tr>\n";
                }
                // Close the file
                fclose($file);
            } else {
                $contents = "<tr><td>Error: Cannot open file ($filename).</td></tr>\n";
            }
        } else {
            $contents = "<tr><td>Error: Cannot open file ($filename).</td></tr>\n";
        }

        $contents .= "</tbody>\n</table>\n<style>table {border-collapse: collapse;} th, td {padding: 8px; border: 1px solid black;} th {text-align: left;}</style>";

        return $contents;
    }
    ?>
    <button onclick="window.location.href='guestbookform.php'">Go back to form</button>
</body>

</html>