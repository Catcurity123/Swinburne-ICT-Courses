<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <title>Lab 6</title>
</head>

<body>
    <h1>Lab 6 Task 2 - Guestbook</h1>
    <form action="guestbooksave.php" method="POST">
        <h3>Enter your details to sign our guest book</h3>
        <div class="form-group">
            <label  for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name">
            <label for="email">Email:</label>
            <input class="form-control" type="text" id="email" name="email">
            <button   type="submit" value="submit">Sign</button>
            <button  type="reset" value="reset">Reset</button>
            <a href="guestbookshow.php" >Show Guest Book</a>
        </div>
    </form>
</body>

</html>