<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <link rel="stylesheet" type="text/css" href="./style/aboutStyleSheet.css" />
    <title>My Job Vacancy System</title>
</head>

<body>
    <header id="navigation-bar">
        <?php
        include('./include/nav.inc')
        ?>
    </header>
    <header>
        <h1>My Assignment Page</h1>
    </header>
    <main>

        <section>
            <h2>Answers to Assignment Questions</h2>
            <ul>
                <li><strong>What is the PHP version installed in Mercury?</strong> <?php echo phpversion(); ?></li>
                <li><strong>What tasks have you not attempted or not completed?</strong> I have done all tasks and implement others additional features.</li>
                <li><strong>What special features have you done or attempted in creating the site that we should know about?</strong></li>
                <ul>
                    <li>1. A modified Navigation Bar for all pages</li>
                    <li>2. Unified, modern theme color for all pages</li>
                    <li>3. The use of some javascript code in the nav bar and post job form</li>
                    <li>4. Crafted notification box for uploading jobs and errors in search form</li>
                    <li>5. Showing vacancies in tabular form instead of text for better user experience</li>
                </ul>
            </ul>

            <h2>Discussion Points</h2>
            <div class="discussion">
                <img src="./style/Discussion.png" alt="Discussion for assignment 1">
            </div>
            <div class="discussion-text">
                <p>I participated in the "Array Processing Techniques" discussion for this assignment. It was extremely useful, and I incorporated some of the techniques shared by my classmates into my work.</p>
            </div>


        </section>

    </main>

    <footer>
        <p>&copy; 2023 My Job Vacancy System. All rights reserved.</p>
    </footer>
</body>

</html>