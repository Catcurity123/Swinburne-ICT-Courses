<!-- Authentication verification -->
<?php include_once "Required.php"; ?>
<?php
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
    <link rel="stylesheet" type="text/css" href="./style/friendadd.css" />
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

        #Initialize page number
        $pageNumber = 0;
        if (isset($_GET["page"])) {
            $pageNumber = $_GET["page"];
        }

        #If the add friend button is clicked
        if (isset($_POST['submit'])) {
            if (isset($_POST["addFriend"])) {
                $friend_ID = sanitize_input($_POST["addFriend"]);
                $fAccount = new Account($db, $friend_ID);
                $friends->AddFriend($User_Account, $fAccount);
                header("Location: friendadd.php?page=$pageNumber");
            }
        }

        #Get a list of user's friends
        $allAccountList = $friends->GetAccount($User_Account->GetId());
        $friendList = $friends->GetFriendList($User_Account->GetId());

        #Get accounts that are not friend with the current user
        $accountList = array_diff($allAccountList, $friendList);

        #Show only 5 account at a time

        $pageArray = array_chunk($accountList, 5, True);
        $nthPageList = array();

        if (array_key_exists(($pageNumber), $pageArray)) {
            $nthPageList = $pageArray[$pageNumber];
        }
        ?>

        <div class="welcome-message">
            <?php echo "<h1>Hi {$User_Account->GetProfileName()}!</h1>" ?>
        </div>



        <div class="page-content">
            <?php
            #Display account that are not friends with the current user
            $accountCount = count($accountList);
            if ($accountCount > 1) {
                if ($accountCount == 1) {
                    echo "<p>Found $accountCount friend account</p>";
                } else {
                    echo "<p>Found $accountCount friend accounts</p>";
                }
            }

            #Display account that can be add as friend
            if (!empty($nthPageList)) {
                echo "<table>";
                echo "<thead><tr><th>Profile Name</th><th>Mutual Friend</th><th>Add as friend</th></tr></thead>";
                echo "<tbody>";
                foreach ($nthPageList as $a) {
                    $acc = new Account($db, $a);

                    $mutFCount = $friends->getMutualFriendCount($User_Account->GetId(), $acc->GetId());
                    $mutFCountStr = $mutFCount == 1 ? "$mutFCount mutual friend" : "$mutFCount mutual friends";

                    echo "<tr>";
                    echo "<td>" . $acc->GetProfileName() . "</td>";
                    echo "<td>" . $mutFCountStr . "</td>";
                    echo "<td>";
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<input type=\"hidden\" name=\"addFriend\" value=\"{$acc->GetId()}\"/>";
                    echo "<input type=\"submit\" name=\"submit\" value=\"Add as friend\"/>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<br>";
            } else {
                echo "<p>No accounts found!</p>";
            }
            ?>
            <!-- Include page forward and backward -->
            <?php $pagedArray;
            $pageNumber;
            include "pagination.php"; ?>
        </div>

    </header>

</body>

</html>