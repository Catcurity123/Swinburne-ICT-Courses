<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Vacancy Form</title>
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <link rel="stylesheet" type="text/css" href="./style/postjobformStyleSheet.css" />
</head>

<body>
    <!-- Include nav bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.inc')
        ?>
    </header>

    <!-- Vacancy form -->
    <h1>Job Vacancy Form</h1>
    <!-- The validation of data will be done in the process file, however, the error will be displayed in this form for better user experience -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <!-- Position ID field -->
        <label for="position-id">Position ID:</label>
        <input type="text" id="position-id" name="position-id">
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Title field -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Description field -->
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Closing Date field -->
        <label for="closing-date">Closing Date:</label>
        <input type="text" id="closing-date" name="closing-date" value="<?php echo date('d/m/y'); ?>">
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Position field -->
        <label for="position">Position:</label>
        <div id="position" style="display: flex; flex-direction: row;">
            <input type="radio" id="position-fulltime" name="position" value="Full-Time">
            <label for="position-fulltime">Full Time</label>
            <input type="radio" id="position-parttime" name="position" value="Part-Time">
            <label for="position-parttime">Part Time</label>
        </div>
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Contract field -->
        <label for="contract">Contract:</label>
        <div id="contract" style="display: flex; flex-direction: row;">
            <input type="radio" id="contract-ongoing" name="contract" value="On-going">
            <label for="contract-ongoing">On-going</label>
            <input type="radio" id="contract-fixedterm" name="contract" value="Fixed term">
            <label for="contract-fixedterm">Fixed term</label>
        </div>
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Accept application field -->
        <label for="accept-application">Accept Application by:</label>
        <div id="accept" style="display: flex; flex-direction: row;">
            <input type="checkbox" id="accept-post" name="accept-application[]" value="Post">
            <label for="accept-post">Post</label>
            <input type="checkbox" id="accept-email" name="accept-application[]" value="Email">
            <label for="accept-email">Email</label>
        </div>
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!-- Location selection-->
        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="">---</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="QLD">QLD</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="VIC">VIC</option>
            <option value="WA">WA</option>
        </select>
        <!-- Add a span element to display the error message -->
        <span class="error-message"></span><br>

        <!--Submit button and reset button-->
        <div style="display: flex; flex-direction: row; justify-content: center; margin-top: 20px;">
            <input type="submit" value="Submit" name="postform">
            <input type="button" value="Reset" onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
        </div>
    </form>
    <br>


    <!-- This part will link this form with the process file to perform data validation -->
    <?php
    require 'postjobprocess.php';

    // If the submit button is pressed the follows will be done
    if (isset($_POST["postform"])) {
        // Return list will contain data validation information, navigate to the process file for more information
        $returnList = PostFormValidation();

        // If there is no error a notification box will appear
        if ($returnList[0] == True) {
            echo '<div id="overlay" class="show">';
            echo '<div class="content-container">';
            echo '<div class="notification-box">' . $returnList[1] . '</div>';
            echo '<div class="button-container"><button class="button" onclick="location.href=\'index.php\'">Return to Home Page</button></div>';
            echo '</div>';
            echo '</div>';
            echo '<script>document.getElementById("overlay").classList.add("show");</script>';
        }

        // If there are any errors, the predefined error string will be displayed below its according field.
        if ($returnList[0] == False) {
            // Position ID, Title, Description ,and Closing date have their own validation rule, others are checked if empty or not
            // Please Navigate to the process file for more information of the validation
            if ($returnList[1] !== "") {
                echo '<script>document.querySelector("#position-id + .error-message").textContent = "' . htmlspecialchars($returnList[1], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[2] !== "") {
                echo '<script>document.querySelector("#title + .error-message").textContent = "' . htmlspecialchars($returnList[2], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[3] !== "") {
                echo '<script>document.querySelector("#description + .error-message").textContent = "' . htmlspecialchars($returnList[3], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[4] !== "") {
                echo '<script>document.querySelector("#closing-date + .error-message").textContent = "' . htmlspecialchars($returnList[4], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[5] !== "") {
                echo '<script>document.querySelector("#position + .error-message").textContent = "' . htmlspecialchars($returnList[5], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[6] !== "") {
                echo '<script>document.querySelector("#contract + .error-message").textContent = "' . htmlspecialchars($returnList[6], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[7] !== "") {
                echo '<script>document.querySelector("#accept + .error-message").textContent = "' . htmlspecialchars($returnList[7], ENT_QUOTES) . '";</script>';
            }
            if ($returnList[8] !== "") {
                echo '<script>document.querySelector("#location + .error-message").textContent = "' . htmlspecialchars($returnList[8], ENT_QUOTES) . '";</script>';
            }
            // The position ID field can be check independently as the two error situations for this field can not happen at the same time 
            // Meaning the Position ID must not be empty OR it must not be unique
            if ($returnList[9] !== "") {
                echo '<script>document.querySelector("#position-id + .error-message").textContent = "' . htmlspecialchars($returnList[9], ENT_QUOTES) . '";</script>';
            }
        }
    }
    ?>

</body>


</html>