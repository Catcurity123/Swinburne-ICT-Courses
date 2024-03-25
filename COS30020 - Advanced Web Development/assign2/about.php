<?php include_once "Required.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
    <link rel="stylesheet" type="text/css" href="./style/about.css" />
    <title>My Friend System</title>
</head>

<body>
    <header id="navigation-bar">
        <?php
        include('./include/nav.php')
        ?>
    </header>
    <header>
        <h1>My Assignment Page</h1>
    </header>
    <main>

        <section>
            <h2>Answers to Assignment Questions</h2>
            <ul>
                <li><strong>What tasks have you not attempted or not completed?</strong> I have done all tasks and implement others additional features.</li>
                <li><strong>What special features have you done or attempted in creating the site that we should know about?</strong></li>
                <ul>
                    <li>1. A modified Navigation Bar for all pages</li>
                    <li>2. Unified, modern theme color for all pages</li>
                    <li>3. Fix every error from labs and assignment 1 (hopefully so)</li>
                </ul>
                <li><strong>What parts did you have trouble with?</strong></li>
                <ul>
                    <li>1. The database configuration and logic regarding user's account</li>
                    <li>2. WINSCP and Swinburne's database working from Vietnam is definitely a pain in the, I spent more time smashing my tables and praying to my ancestors trying to connect to WinSCP than actually coding</li>
                </ul>
                <li><strong>What would you like to do better next time?</strong> I have not got enough time to implement some box message like I did in assignment 1, next timw I will spend more time doing this</li>
            </ul>

            <h2>Discussion Points</h2>
            <div class="discussion">
                <img src="./style/Discussion1.png" alt="Discussion for assignment 2">
                <img src="./style/Discussion2.png" alt="Discussion for assignment 2">
            </div>
            <div class="discussion-text">
                <p>I participated in the "The use of destructor and magic method" discussion for this assignment. It was extremely useful, and I incorporated some of the techniques shared by my classmates into my work.</p>
            </div>


        </section>

    </main>

    <footer>
        <p>&copy; 2023 My Friend System. All rights reserved.</p>
    </footer>
</body>

</html>