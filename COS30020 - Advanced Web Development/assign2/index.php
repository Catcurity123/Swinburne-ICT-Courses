<?php include_once "Required.php";?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/index.css" />
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <title>My Friend System | Assignment 2</title>
</head>

<body>
    <!-- Include Nav Bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.php')
        ?>
    </header>
    <header>
        <h1>My Friend System | Assignment 2</h1>
    </header>
    <main>
        <!-- Requested information -->
        <section>
            <h2>About Me</h2>
            <ul>
                <li><strong>Name:</strong> Vi Luan Dang</li>
                <li><strong>Student SIMS number:</strong> 103802759</li>
                <li><strong>Email:</strong> 103802759@student.swin.edu.au</li>
            </ul>
            <p class="declaration">I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.</p>
        </section>

        <!-- Links to other features -->
        <section>
            <h2>Friend System</h2>
            <nav>
                <ul>
                    <li><a href="login.php">Login into an account</a></li>
                    <li><a href="signup.php">Register an account</a></li>
                    <li><a href="about.php">About this Assignment</a></li>
                </ul>
            </nav>
        </section>

        <!-- System Message for database initialization and population -->
        <section>
            <h2>System Message</h2>
            <?php
            #Initialize variables
            $db = new DataBase();
            #Initialize database and display error if fails
            if ($db->InitDatabase()) {
                echo "<p class=\"success_text\">Tables successfully created!</p>";
                $db->CloseConnection();
            } else {
                $TableInitFlag = false;
                echo "<p class=\"error_text\">Unable to setup tables.</p>";
                $db->CloseConnection();
            }
            $TableInitFlag = true;


            #Check if the drop button was pressed
            if (isset($_POST['drop'])) {
                $db->DropTables();
                include "logout.php";
                echo "<p class=\"success_text\">Tables successfully dropped!</p>";
                $TableInitFlag = false;
            }

            #Check if the populate button was pressed
            if (isset($_POST['populate'])) {
                #Populate database if created successfully
                if ($TableInitFlag) {
                    if ($db->PopulateSampleData()) {
                        echo "<p class=\"success_text\">Tables successfully populated!</p>";
                        $db->CloseConnection();
                    } else {
                        echo "<p class=\"error_text\">Data already existed!, Consider dropping the table before inserting duplicated sample data</p>";
                        $db->CloseConnection();
                    }
                }
            }
            ?>
            <!-- Display buttons to drop and populate tables -->

            <form method="POST">
                <button type="submit" class="outline float-right" name="drop">Drop Tables</button>
                <button type="submit" class="float-right" name="populate">Populate Tables</button>
                <div style="clear:both;"></div> <!-- Add this line to clear the floats -->
            </form>
        </section>
    </main>
    <!-- Requested information -->
    <footer>
        <p>&copy; 2023 My Friend System. All rights reserved.</p>
    </footer>
</body>

</html>