<?php
session_start();
//$action = $_REQUEST['action'];

if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
  $listings = "";
} else {
  //do nothing
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="css/styles_register.css">
  <script src="scripts/jscript_other.js"></script>
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
            echo '<li><div><a href="profile_page.php" class="hover" >'.$user_name.'</a></div></li>';
            echo '<li><div><a href="logout.php" class="hover" >Logout</a></div></li>';
          } ?>
          <li><div id="time" class="hover"></div></li>
        </div>
      </ul>
    </div>
  </div>

  <div id="requestresetform">
    <h2>Reset Password</h2>
    <?php include 'passwordform.php';?>
  </div>

  <?php include 'banner.php'; ?>
</body>
</html>
