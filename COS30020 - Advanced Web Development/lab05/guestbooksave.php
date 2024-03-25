<?php
// Get the guest names from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
if (!is_dir('../../data/lab05')) {
    umask(0007);
    $dir = "../../data/lab05";
    mkdir($dir, 02770);
}

$filename = "../../data/lab05/guestbook.txt";

$result = saveGuestbookEntry($firstname, $lastname, $filename);
echo $result;

function saveGuestbookEntry($firstname, $lastname, $filename)
{
    // Check if both guest names are provided
    if (empty($firstname) || empty($lastname)) {
        //Initialize error if first or last name is not found
        $error = "<span style='color:red'>You must enter your first and last name!</span>";
        $error .= "<span style='color:red'>Use the Browser's 'Go Back' button to return to the Guestbook form</span></br>";
        $error .= '<button onclick="window.location.href=\'guestbookform.php\'">Show Guestbook</button>';
        echo $error;
        return;
    }

    // Open the guestbook file for appending
    $file = fopen($filename, "w");

    // Check if the file was opened successfully
    if (!$file) {
        //Initialize error if file is not found
        $error = "<span style='color:red'>Error: Cannot open file ($filename).</span>";
        $error .= "<br><button onclick='window.history.back()'>Go Back</button>";
        echo $error;
        return;
    }

    // Escape any special characters in the guest names
    $firstname = addslashes($firstname);
    $lastname = addslashes($lastname);

    // Write the guest names to the file
    if (fwrite($file, $firstname . " " . $lastname . PHP_EOL)) {
        $success = "<span style='color:green'>Thank you for signing the Guest book.</span>";
        $success .= '<br><button onclick="window.location.href=\'guestbookshow.php\'">Show Guestbook</button>';
        echo $success;
    } else {
        $error = "<span style='color:red'>Error: Cannot add your name to the Guest book.</span>";
        $error .= "<br><button onclick='window.history.back()'>Go Back</button>";
        echo $error;
    }

    // Close the file
    fclose($file);
}
