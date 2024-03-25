<!DOCTYPE html>
<html>

<head>
    <title>Job Vacancy Information</title>
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <link rel="stylesheet" type="text/css" href="./style/searchjobprocessStyleSheet.css" />
</head>

<body>
    <!-- Include nav bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.inc')
        ?>
    </header>

    <?php
    include("./Functions/functions.php");
    // Validate the Job Title and the existence of the job text file
    if (isset($_GET["searchform"])) {
        // Return list will contain search data validation information, navigate to the functions file in the Functions folder for more information
        $returnList = SearchValidation();
        // If errors occured
        if ($returnList[0] == False) {
            // If errors related to the job title occur then show a notification box
            if ($returnList[1] !== "") {
                echo '<div id="overlay" class="show">';
                echo '<div class="content-container">';
                echo '<div class="notification-box">' . $returnList[1] . '</div>';
                echo '<div class="button-container"><button class="button" onclick="location.href=\'searchjobform.php\'">Return to Search Page</button></div>';
                echo '</div>';
                echo '</div>';
                echo '<script>document.getElementById("overlay").classList.add("show");</script>';
            }
            // If errors related to the job file occur then show a notification box
            if ($returnList[2] !== "") {
                echo '<div id="overlay" class="show">';
                echo '<div class="content-container">';
                echo '<div class="notification-box">' . $returnList[2] . '</div>';
                echo '<div class="button-container"><button class="button" onclick="location.href=\'searchjobform.php\'">Return to Search Page</button></div>';
                echo '</div>';
                echo '</div>';
                echo '<script>document.getElementById("overlay").classList.add("show");</script>';
            }
            exit;
        }
    }

    // Cleanse and obtain the data
    $job_Title = trim($_GET['job-title']);
    $job_Position = trim($_GET['job-position']);
    $job_application_Type = trim($_GET['job-application-type']);
    $job_Contract = trim($_GET['job-contract']);
    $job_Location = trim($_GET['job-location']);
    // Sanitize the data for search query, navigate to the functions file in the Functions folder for more information
    $search_Array = Sanitize_Search_Array(array($job_Title, $job_Position, $job_Contract, $job_application_Type, $job_Location));
    // Specify the path for the file
    $job_File = '../../data/jobposts/jobs.txt';
    // Read the data from the jobs file
    $jobs_Data = file_get_contents($job_File);
    // Search for the job title in each job vacancy record
    $job_Vacancies = array();
    $job_Records = explode("\n", $jobs_Data);
    foreach ($job_Records as $job_Record) {
        // If the record is blank then move to the next record
        if ($job_Record == "") {
            continue;
        }
        // Prepare the record for validation
        $Sanitized_job_Record = str_replace("\t", "|", $job_Record);
        $job_Fields = explode("|", $Sanitized_job_Record);
        // Validate and search for the job according to the file, navigate to functions file in the Function folder for more information
        if (Job_Validation($job_Fields, $search_Array)) {
            // Inititate check for closing date, if the closing date is before today then move to the next record as that job has expired
            $closing_date = DateTime::createFromFormat('d/m/y', $job_Fields[3]);
            if ($closing_date >= new DateTime('today')) {
                // Store validated job vacancy in an array, N/A if blank
                $job_Vacancies[] = array(
                    "title" => $job_Fields[1] ?? 'N/A',
                    "description" => $job_Fields[2] ?? 'N/A',
                    "closing_date" => $job_Fields[3] ?? 'N/A',
                    "position" => $job_Fields[4] ?? 'N/A',
                    "application_by" => $job_Fields[6] ?? 'N/A',
                    "location" => $job_Fields[7] ?? 'N/A'
                );
            }
        }
    }

    // Sort the job vacancies by closing date in ascending order
    usort($job_Vacancies, function ($a, $b) {
        return strtotime($a['closing_date']) - strtotime($b['closing_date']);
    });

    // Generate the HTML output
    echo "<h1>Job Vacancy Information</h1>";
    // If there is no vacancy then displayed an error
    if (count($job_Vacancies) == 0) {
        echo "<div class='no-results'>No job vacancies found. Type 'Any' to list all current vacancies </div><br/>";
        echo "<a href='index.php'>Return to Home Page</a> | ";
        echo "<a href='searchjobform.php'>Return to Search Job Vacancy Page</a>";
        //else output an table of the vacancies
    } else {
        echo "<table>";
        echo "<thead><tr><th>Title</th><th>Description</th><th>Closing Date</th><th>Position</th><th>Application By</th><th>Location</th></tr></thead>";
        echo "<tbody>";
        foreach ($job_Vacancies as $job_Vacancy) {
            echo "<tr>";
            echo "<td>" . $job_Vacancy['title'] . "</td>";
            echo "<td>" . $job_Vacancy['description'] . "</td>";
            echo "<td>" . $job_Vacancy['closing_date'] . "</td>";
            echo "<td>" . $job_Vacancy['position'] . "</td>";
            echo "<td>" . $job_Vacancy['application_by'] . "</td>";
            echo "<td>" . $job_Vacancy['location'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        echo "<a href='index.php'>Return to Home Page</a> | ";
        echo "<a href='searchjobform.php'>Return to Search Job Vacancy Page</a>";
    }
    ?>

</body>

</html>

</html>