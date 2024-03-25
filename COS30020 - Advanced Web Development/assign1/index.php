<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/indexStyleSheet.css" />
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <title>My Job Vacancy System</title>
</head>

<body>
    <!-- Include Nav Bar -->
    <header id="navigation-bar">
        <?php
        include('./include/nav.inc')
        ?>
    </header>
    <header>
        <h1>My Job Vacancy Form</h1>
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

        <section>
            <!-- Links to other features -->
            <h2>Job Vacancy System</h2>
            <nav>
                <ul>
                    <li><a href="postjobform.php">Post a Job Vacancy</a></li>
                    <li><a href="searchjobform.php">Search for Job Vacancies</a></li>
                    <li><a href="about.php">About this Assignment</a></li>
                </ul>
            </nav>
        </section>
    </main>
    <!-- Requested information -->
    <footer>
        <p>&copy; 2023 My Job Vacancy System. All rights reserved.</p>
    </footer>
</body>

</html>