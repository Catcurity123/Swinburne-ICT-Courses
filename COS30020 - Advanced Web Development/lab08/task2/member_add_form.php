<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Dang Vi Luan" />
    <title> Add Members Form </title>
</head>

<body>
    <?php include('vip_members.php'); ?>
    <br>
    <div>
        <form action="./member_add.php" method="post">
            <p><label for="fname"><b> First Name: </b></label>
                <input type="text" name="fname" id="fname">
            </p>

            <p><label for="lname"><b> Last Name: </b></label>
                <input type="text" name="lname" id="lname">
            </p>

            <p><label for="gender"><b> Gender: </b></label>
                <input type="text" name="gender" id="gender">
            </p>

            <p><label for="email"><b> Email: </b></label>
                <input type="text" name="email" id="email">
            </p>

            <p><label for="phone"><b> Phone: </b></label>
                <input type="text" name="phone" id="phone">
            </p>

            <p><input type="submit" name="submit"></p>
            <p><input type="reset" name="reset"></p>
        </form>
    </div>
</body>

</html>