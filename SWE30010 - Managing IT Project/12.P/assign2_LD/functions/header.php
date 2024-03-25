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
        <img src="style/logo.png" class="logo" alt="logo">
        <div class="menu-toggle"></div>
        <nav>
            <ul>
                <li><a class="<?php active('index.php'); ?>" href="index.php">Home</a></li>
                <li><a class="<?php active('info.php'); ?>" href="info.php">PATIENT INFO</a></li>
                <li><a class="<?php active('signup.php'); ?>" href="signup.php">SIGN UP</a></li>
                <li><a class="<?php active('login.php'); ?>" href="login.php">LOG IN</a></li>
                <li><a class="<?php active('logout.php'); ?>" href="logout.php">LOG OUT</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
</header>

<script>
    //this js file actives the responsive menu
    <?php include 'menu.js'; ?>
</script>