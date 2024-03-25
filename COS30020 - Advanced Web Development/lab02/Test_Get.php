<form action = "#">
    <input type="text" name="Name"/>
    <input type="submit" value="Submit" name="Sub">
</form>

<?php
if (isset($_GET['Name'])){
    echo $_GET['Name'];
}
?>

<form method="post" action="Test_post.php">
      Name: <input type = "text" name = "name"/><br>
      Number: <input type = "text" name = "number"/><br>
      <input type = "submit" value = "submit" name = "sub">
</form>