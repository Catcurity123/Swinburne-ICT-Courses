<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Authenticating the user -->
        <?php
        $db = new DataBase();
        $auth = new Authentication($db);
        $isAuth = $auth->Authenticated();

        if ($isAuth) {
            $session = $auth->getAuthSession();
            $User_Account = new Account($db, $session["USER_ID"]);
        }
        ?>
        <!-- Changing the nav bar according to the user's authentication status -->
        <ul class="navbar-nav">
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <!-- Only show the sign up and log in nav bar if the user is not sign in -->
            <?php
            if (!$isAuth) {
            ?>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'signup.php') echo 'active'; ?>">
                    <a class="nav-link" href="signup.php">Register</a>
                </li>

                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') echo 'active'; ?>">
                    <a class="nav-link" href="login.php">Log in</a>
                </li>

                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'friendadd.php') echo 'active'; ?>">
                <?php
                if ($isAuth) {
                    echo '<a class="nav-link" href="friendadd.php">View Friend</a>';
                } else {
                    echo '<a class="nav-link" href="friendadd.php" onclick="alert(\'You must log in or register to view your friends.\')">View Friend</a>';
                }
                ?>
                </li>
                
            <?php
            }
            ?>

            <!-- Show the friends section but hid the logging in and signing up as user is already signed in -->
            <?php
            if ($isAuth) {
            ?>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'friendlist.php') echo 'active'; ?>">
                    <a class="nav-link" href="friendlist.php">Friend List</a>
                </li>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'friendadd.php') echo 'active'; ?>">
                    <a class="nav-link" href="friendadd.php">Friend Add</a>
                </li>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') echo 'active'; ?>">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            <?php
            }
            ?>

            <!-- About is standard -->
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active'; ?>">
                <a class="nav-link" href="about.php">About</a>
            </li>
        </ul>
    </div>
</nav>