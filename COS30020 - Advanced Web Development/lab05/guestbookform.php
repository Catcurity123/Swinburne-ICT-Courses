<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Guestbook Form</title>
</head>

<body>
    <h1>Guestbook Form</h1>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend><strong>Enter your details to sign our guestbook:</strong></legend>
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname"><br><br>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname"><br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <p><a href="guestbookshow.php">Show Guest Book</a></p>
</body>

</html> 