<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="./style/style.css" />
<link rel="stylesheet" type="text/css" href="./style/searchjobformStyleSheet.css" />

<head>
    <title>Job Vacancy Search</title>
</head>

<body>
    <!-- Include nav bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.inc')
        ?>
    </header>

    <!-- Search form -->
    <h1>Job Vacancy Search</h1>
    <!-- The retrieval of data will be done in the process file -->
    <form method="GET" action="searchjobprocess.php">
        <!-- Job Title field -->
        <label for="job-title">Job Title:</label>
        <input type="text" id="job-title" name="job-title" value="Any">
        <!-- Job Position field -->
        <label for="job-position">Position:</label>
        <select id="job-position" name="job-position">
            <option value="Any">Any</option>
            <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
        </select>
        <!-- Contract field -->
        <label for="job-contract">Contract:</label>
        <select id="job-contract" name="job-contract">
            <option value="Any">Any</option>
            <option value="On-going">On-going</option>
            <option value="Fixed term">Fixed term</option>
        </select>
        <!-- Job Application field -->
        <label for="job-application-type">Application Type:</label>
        <select id="job-application-type" name="job-application-type">
            <option value="Any">Any</option>
            <option value="Post">Post</option>
            <option value="Email">Email</option>
        </select>
        <!--  job locaition field -->
        <label for="job-location">Location:</label>
        <select id="job-location" name="job-location">
            <option value="Any">Any</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="QLD">QLD</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="VIC">VIC</option>
            <option value="WA">WA</option>
        </select>

        <div style="display: flex; flex-direction: row; justify-content: center; margin-top: 20px;">
        <!-- Submit button -->
            <button type="submit" name="searchform">Search</button>
        </div>
    </form>
    <br>

</body>

</html>