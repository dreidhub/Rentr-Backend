<?php
session_start();
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
  //echo 'Welcome '.$_SESSION['userName'].'';
} else {
  //echo 'You are not logged in.';
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="css/styles_profile.css">
  <script src="scripts/jscript_profile.js"></script>
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
  <?php if(isset($_SESSION['userName'])){
    echo '
    <div id="profile" class="shown">
    <h2>Your Profile</h2>
    <div id="listings" class="border">
        <div id="listingstxt">Your Listings</div>
          <button id="toggle-listings" onclick="show()"></button>
          <div id="listing-expand" style="display:none;">
    ';
    include "profilelisting.php";
    echo '</div>
    </div>
    <div id="tenantapplications" class="border">
      <div id="listingstxt">Your Applications</div>
    </div>
    <div id="landlordapplications" class="border">
      <div id="listingstxt">Received Applications</div>
    </div>
    </div>';
  } else {
    echo '<div id="profile" class="shown">
    <h3>You are not logged in, redirecting you now.</h3>';
    echo header("refresh:0;url=login.php");
  }
  ?>
  <?php include 'banner.php'; ?>
</body>
</html>
