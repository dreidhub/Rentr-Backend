<?php
session_start();
session_destroy();
//echo "You have been logged out, redirecting you to the home page.";
echo header("refresh:0;url=index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="css/styles.css">
  <script src="scripts/jscript.js"></script>
  <link rel="shortcut icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
  <link rel="icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
</head>
<body>
  <div id="banner">

    <img id="logo" src="css/images/Rentr_white_text_logo.png">  <!-- Biddr Logo Goes Here -->

  </div>

  <div id="nav">
    <div id="nav-wrapper">
      <ul class='leftnav'>
        <li><div><a href="index.php" class="hover" >Home</a></div></li>
        <li><div><a href="proprent_page.php" class="hover" >Properties for rent</a></div></li>
        <li><div><a href="createlisting_page.php" class="hover" >Create listing</a></div></li>
        <li><div><a href="faq_page.php" class="hover" >F.A.Q</a></div></li>
        <div id="rightnav">
          <?php if(!isset($_SESSION['userName'])){
            echo '<li><div><a href="login.php" class="hover" >Login</a></div></li>';
            echo '<li><div><a href="registeruser_page.php" class="hover" >Register</a></div></li>';
          } else {
            echo '<li><div><a href="login.php" class="hover" >Login</a></div></li>';
            echo '<li><div><a href="registeruser_page.php" class="hover" >Register</a></div></li>';
          } ?>
          <li><div id="time" class="hover"></div></li>
        </div>
      </ul>
    </div>
  </div>

  <div id="logoutline">
    <h3>You have been logged out, redirecting you now...</h3>
  </div>

  <div id="footer">
    <p class="copyright">
      Copyright Rentr.co.nz 2017
    </p>
    <p class="nzowned">
      Proudly 100% New Zealand owned &amp; operated
    </p>
    <p class="contact">
      <a href="contact_form.php">Contact us</a>
    </p>
  </div>
</body>
</html>
