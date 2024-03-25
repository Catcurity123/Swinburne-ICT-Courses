<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'postjobform.php') echo 'active'; ?>">
        <a class="nav-link" href="postjobform.php">Post Job</a>
      </li>
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'searchjobform.php') echo 'active'; ?>">
        <a class="nav-link" href="searchjobform.php">Find Job</a>
      </li>
      <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active'; ?>">
        <a class="nav-link" href="about.php">About</a>
      </li>
    </ul>
  </div>
</nav>