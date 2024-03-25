<?php
    //this function determines which page is Active
    function active($current_page) {
      $url_array =  explode('/', $_SERVER['REQUEST_URI']);
      $url = end($url_array);  
      if($current_page == $url) {
          echo 'active'; //class name in css 
      } 
    }
?>

<!-- Header for all pages -->
<header>
        <img src="style/logo.jpg" class="logo" alt="logo">
        <div class="menu-toggle"></div>
        <nav>
            <ul>
                <li><a class="<?php active('index.php');?>" href="index.php">HOME</a></li>
                <li><a class="<?php active('about.php');?>" href="about.php" class="active">ABOUT</a></li>
                <li><a class="<?php active('friendlist.php'); ?>" href="friendlist.php">MY FRIEND LIST</a></li>
                <li><a class="<?php active('friendadd.php'); ?>" href="friendadd.php">ADD FRIENDS</a></li>
                <li><a class="<?php active('signup.php'); ?>" href="signup.php">SIGN UP</a></li>
                <li><a class="<?php active('login.php'); ?>" href="login.php">LOG IN</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
</header>

<script>
    //this js file actives the responsive menu
    <?php include 'menu.js'; ?>
</script>