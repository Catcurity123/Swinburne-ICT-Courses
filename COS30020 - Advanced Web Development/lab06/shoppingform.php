<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <title>Lab 6</title>
</head>

<body>
    <h1>Web Programming Form - Lab 6</h1>
    <form action="shoppingsave.php" method="POST">
        <div class="form-group">
            <label  for="item">Item Name:</label>
            <input class="form-control" type="text" id="item_name" name="item">
            <label for="quantity">Quantity:</label>
            <input class="form-control" type="number" id="quantity" name="quantity">
            <button class="btn btn-primary" type="submit" value="submit">Save</button>
        </div>
    </form>
</body>

</html>