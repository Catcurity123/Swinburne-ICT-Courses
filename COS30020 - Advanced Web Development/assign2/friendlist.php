<!-- Authentication verification -->
<?php
include_once "Required.php";
$db = new DataBase();
$auth = new Authentication($db);

if (!$auth->Authenticated()) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/friendlist.css" />
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
        <?php
        #Get user's Session
        $session = $auth->getAuthSession();
        $User_Account = new Account($db, $session["USER_ID"]);
        $friends = new Friends($db);

        #If the  unfriend button is clicked
        if (isset($_POST['submit'])) {
            if (isset($_POST["Unfriend"])) {
                $friend_ID = sanitize_input($_POST["Unfriend"]);
                $fAccount = new Account($db, $friend_ID);
                $friends->RemoveFriend($User_Account, $fAccount);
            }
        }

        #Get a list of user's friends
        $friendList = $friends->GetFriendList($User_Account->GetId());
        $friendList = SortAccount($db, $friendList)
        ?>

        <div class="welcome-message">
            <?php echo "<h1>Hi {$User_Account->GetProfileName()}!</h1>" ?>
        </div>

        <div class="page-content">
            <?php
            #Display account that are not friends with the current user
            echo "<p>Here's your friend list. ({$User_Account->GetNumOfFriend()} friends)</p>";
            #Display account that are friends
            if (!empty($friendList)) {
                echo "<table>";
                echo "<thead><tr><th>Profile Name</th><th>Unfriend</th></tr></thead>";
                echo "<tbody>";
                foreach ($friendList as $f) {
                    $fAccount = new Account($db, $f);
                    echo "<tr>";
                    echo "<td>" . $fAccount->GetProfileName() . "</td>";
                    echo "<td>";
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<input type=\"hidden\" name=\"Unfriend\" value=\"" . $fAccount->GetID() . "\" />";
                    echo "<input type=\"submit\" value=\"Unfriend\" name=\"submit\" />";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<br>";
            } else {
                echo "<p>You have no friends</p>";
            }
            ?>
        </div>
    </header>


</body>

</html>