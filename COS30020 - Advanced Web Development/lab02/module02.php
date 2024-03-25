
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Programming :: Lab 2" />
<meta name="keywords" content="Web,programming" />

<title>Using variables, arrays and operators</title>
</head>

<body>
<h1>Web Programming - Lab 2</h1>
    <?php         
      //Initialize and populate array         
      $marks = array(85, 85, 95);         
      $marks[1] = 90;         
            
      //Calculate average point         
      $ave = array_sum($marks) / count($marks);         
            
      //Ternary operator to check for passing condition         
      $status = ($ave >= 50) ? "PASSED" : "FAILED";         
            
      //Print out the result         
      echo "The average score is ".$ave;         
      echo " You ".$status."\n";         
    ?>   
</body>

</html>



