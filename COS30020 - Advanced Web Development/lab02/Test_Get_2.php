<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Display a form for the user to input data
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <br>
        <input type="submit" value="Submit">
    </form>
    <?php
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form data submitted via POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    echo "Hello, $name! Your email is $email.";
}
?>