

<?php

// This file contains additional functions for the web

// If the job title in the search form is 'Any' then search for any job
function Sanitize_Search_Array($array)
{
    $Sanitized_Search_Array = $array;
    if ($array[0] === 'Any') {
        $Sanitized_Search_Array[0] = 'Any';
    }
    return $Sanitized_Search_Array;
}

// This function validate the search input in the search form with each records in the job file
function Job_Validation($job_Array, $search_Array)
{
    //If any of the input is 'Any' then no need to check and move to the next input
    if (!($search_Array[0] === 'Any')) {
        // If the input is contained within the job title of the job file then it is correct, else return false
        $check_job_Title = strpos(strtolower($job_Array[1]), strtolower($search_Array[0])) !== false;
        if (!$check_job_Title) {
            return False;
        }
    }

    if (!($search_Array[1] === 'Any')) {
        // If the input is similar to the job file then it is correct, else return false
        $check_job_Position = (strcmp(strtolower($job_Array[4]), strtolower($search_Array[1]))) == 0;
        if (!$check_job_Position) {
            return False;
        }
    }

    if (!($search_Array[2] === 'Any')) {
        // If the input is similar to the job file then it is correct, else return false
        $check_job_Contract = (strcmp(strtolower($job_Array[5]), strtolower($search_Array[2]))) == 0;
        if (!$check_job_Contract) {
            return False;
        }
    }

    if (!($search_Array[3] === 'Any')) {
        // If the input is similar to the job file then it is correct, else return false, application type can be any of the types
        $job_application_types = explode(',', $job_Array[6]);
        $check_job_application_Type = false;
        foreach ($job_application_types as $application_type) {
            if (strcasecmp(trim($application_type), $search_Array[3]) == 0) {
                $check_job_application_Type = true;
                break;
            }
        }
        if (!$check_job_application_Type) {
            return False;
        }
    }
    // If the input is similar to the job file then it is correct, else return false
    if (!($search_Array[4] === 'Any')) {
        $check_job_Location = (strcmp(strtolower($job_Array[7]), strtolower($search_Array[4]))) == 0;
        if (!$check_job_Location) {
            return False;
        }
    }
    // return true, meaning that the record is appropriate for this query, if no error occur
    return true;
}

//This function Validate the job title and check if the job file existed before committing the search query
function SearchValidation()
{
    //Initiate $error flag and $ErrorList array
    $error = False; // Assume there is no error at the beginning
    $ErrorList = array_fill(0, 3, "");
    //If the job-title doesnot exist or it is blank then show the error
    if (!isset($_GET['job-title']) || $_GET['job-title'] == "") {
        $Job_Title_error = "Error: Please enter a job title to search for. <br>";
        $ErrorList[1] = $Job_Title_error;
        $error = True;
    }
    //If the files does not exist then show the error
    $job_File = '../../data/jobposts/jobs.txt';
    if (!file_exists($job_File)) {
        $Job_File_error = "Error: No Job Data found. <br>";
        $ErrorList[2] = $Job_File_error;
        $error = True;
    }

    //If there is an error then switch the flag, else return it
    if ($error == True) {
        $ErrorList[0] = False;
        return $ErrorList;
    } else {
        $ErrorList[0] = True;
        return $ErrorList;
    }
}
