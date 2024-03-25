
<?php
// Check if jobposts directory exists and create it if it does not
if (!is_dir('../../data/jobposts')) {
    umask(0007);
    $dir = "../../data/jobposts";
    mkdir($dir, 02770);
}

// This function is used to save the Vacancy if no errors occur
function SaveRecord($filePath, $record)
{
    $handle = fopen($filePath, 'a');
    fwrite($handle, $record);
    fclose($handle);
    $message = [True, "Job vacancy posted successfully!"];  //$message is an array, the first element is used to check if error occur or not
    return $message;
}

// This function is used to validate post form data
function PostFormValidation()
{
    //Data validation rule according to the requirement of this assignment
    $PositionIdRule = !preg_match('/P\d{4}/', $_POST['position-id']);
    $TitleRule = !preg_match('/^[A-Za-z0-9\s,!\.]{1,20}$/', $_POST['title']);
    $DescriptionRule = strlen($_POST['description']) > 260;
    $ClosingDateRule = !preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $_POST['closing-date']);
    //Initiate $error flag and $ErrorList array
    $error = False; // Assume there is no error at the beginning
    $ErrorList = array_fill(0, 10, "");


    // Validate form data

    //If the data is empty or violate the rules above, the error string will be added to the $ErrorList array
    //$error flag is set to true to indicate that error occured
    if (empty($_POST['position-id']) || $PositionIdRule) {
        $Position_ID_error = "Invalid Position ID. Please enter a Position ID in the format Pxxxx.";
        $ErrorList[1] = $Position_ID_error;
        $error = True;
    }
    //If the data is empty or violate the rules above, the error string will be added to the $ErrorList array
    if (empty($_POST['title']) || $TitleRule) {
        $Title_error = "Invalid Title. Title can only contain a maximum of 20 alphanumeric characters including spaces, comma, period (full stop), and exclamation point.";
        $ErrorList[2] = $Title_error;
        $error = True;
    }
    //If the data is empty or violate the rules above, the error string will be added to the $ErrorList array
    if (empty($_POST['description']) || $DescriptionRule) {
        $Description_error = "Invalid Description. Description cannot be empty and must be no more than 260 characters long.";
        $ErrorList[3] = $Description_error;
        $error = True;
    }
    //If the data is empty or violate the rules above, the error string will be added to the $ErrorList array
    if (empty($_POST['closing-date']) || $ClosingDateRule) {
        $Closing_Date_error = "Invalid Closing Date. Closing date must be in dd/mm/yy format.";
        $ErrorList[4] = $Closing_Date_error;
        $error = True;
    }
    //If the data is empty, the error string will be added to the $ErrorList array
    if (empty($_POST['position'])) {
        $Position_error = "This Field must not be empty, Please choose a value.";
        $ErrorList[5] = $Position_error;
        $error = True;
    }
    //If the data is empty, the error string will be added to the $ErrorList array
    if (empty($_POST['contract'])) {
        $Contract_error = "This Field must not be empty, Please choose a value.";
        $ErrorList[6] = $Contract_error;
        $error = True;
    }
    //If the data is empty, the error string will be added to the $ErrorList array
    if (empty($_POST['accept-application'])) {
        $Accept_app_error = "This Field must not be empty, Please choose a value.";
        $ErrorList[7] = $Accept_app_error;
        $error = True;
    }
    //If the data is empty, the error string will be added to the $ErrorList array
    if (empty($_POST['location'])) {
        $Location_error = "This Field must not be empty, Please choose a value.";
        $ErrorList[8] = $Location_error;
        $error = True;
    }
    //If there is no error, this if statement will be executed
    if ($error == False) {
        $accept_application = implode(',', $_POST['accept-application']);
        // Create a record to add to the text file
        $record = $_POST['position-id'] . "\t" . $_POST['title'] . "\t" . $_POST['description'] . "\t" . $_POST['closing-date'] . "\t" . $_POST['position'] . "\t" . $_POST['contract'] . "\t" . $accept_application . "\t" . $_POST['location'] . "\n";
        $file = '../../data/jobposts/jobs.txt';

        // Check if Position ID is unique if only this is not the first submit
        if (file_exists($file)) {
            $lines = file($file);
            foreach ($lines as $line) {
                $fields = explode("\t", $line);
                if ($fields[0] == $_POST['position-id']) {
                    $Unique_ID_error = "Position ID already exists. Please enter a different Position ID.";
                    $ErrorList[9] = $Unique_ID_error;
                    $error = True;
                    break;
                }
            }
        }
    }

    //If there is error then return the ErrorList to be displayed, else save the record and display the successful notification box
    if ($error == True) {
        $ErrorList[0] = False;
        return $ErrorList;
    } else {
        $message = SaveRecord($file, $record);
        return $message;
    }
}
?>

