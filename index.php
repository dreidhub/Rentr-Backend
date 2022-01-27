<?php
session_start();
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
  //$agentid = $_SESSION['agentid'];
  //echo $agentid;
  $listings = "";
} else {
  //do nothing
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="css/styles_index.css">
  <link type="text/css" rel="stylesheet" href="css/styles_listing.css">
  <script src="scripts/jscript_other.js"></script>
  <link rel="shortcut icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
</head>
<body>
  <div id="banner">

    <a href="index.php"><img id="logo" src="css/images/Rentr_white_text_logo.png"></a> <!-- Rentr Logo Goes Here -->

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

  <div id="searchbar">
    <?php include 'searchbar.php';?>
  </div>

  <div id="homepage" class="shown">
    <div id="hometxt">
        <h2>Welcome to Rentr!</h2>
      <p>
        Find places to rent in the area you want!
      </p>
    </div>

    <div id="listingbox">
      <div id="listingstxt">
        New Listings
      </div>
      <?php
      include 'listingdisplay_index.php';
      ?>
    </div>

    <div id="hotlistingbox">
      <div id="listingstxt">
        Hot Listings
      </div>
      <?php
      include 'listingdisplay_index.php';
      ?>
    </div>

  </div>

  <?php include 'banner.php'; ?>
</body>
</html>
