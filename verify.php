<?php
session_start();
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
  $agentid = $_SESSION['agentid'];
  //echo $agentid;
  //$listings = "";
} else {
  //do nothing
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="styles_register.css">
  <script src="registerform_jscript.js"></script>
  <link rel="shortcut icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
</head>
<body>
  <div id="banner">

    <img id="logo" src="images/Rentr_white_text_logo.png">  <!-- Rentr Logo Goes Here -->

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

  <div id="verifyuser">
    <h2>Verify user</h2>
    <div>
      <?php

      include 'connection.php';

      if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

        // INSERT SECURITY CHECK FOR DATABASE TO HASH ========================================================================
        //echo $_GET['email'];
        // Verify data
        $email = $conn->real_escape_string($_GET['email']); // Set email variable
        //echo $email;
        $hash = $conn->real_escape_string($_GET['hash']); // Set hash variable
        //echo $hash;

        $search = mysqli_query($conn, "SELECT usercontact.contactemail, users.hash, users.verified FROM users, usercontact WHERE usercontact.contactemail='".$email."' AND users.hash='".$hash."' AND users.verified='false'") or die(mysql_error());
        //var_dump($search);
        $match  = mysqli_num_rows($search);
        //echo $match;
        //var_dump($search);

        if($match > 0){
          // We have a match, activate the account
          //echo 1;
          while($row = mysqli_fetch_array($search)){
            //$contactemail = $row['contactemail'];
            //var_dump($contactemail);
            $retval69 = mysqli_query($conn, "UPDATE users SET verified='true' WHERE id='".$agentid."' AND hash='".$hash."' AND verified='false'") or die(mysql_error());
            //var_dump($retval69);
            echo '<div class="success-messageFull">Your account has been activated, you can now login</div>';
          }
        } else {
          //echo 2;
          // No match -> invalid url or account has already been activated.
          echo '<div class="error-messageFull">The url is either invalid or you already have activated your account.</div>';
        }

      } else {
        //echo 3;
        // Invalid approach
        echo '<div class="error-messageFull">Invalid approach, please use the link that has been send to your email.</div>';
      }
      $conn->close();
      ?>
    </div>
  </div>

  <?php include 'banner.php'; ?>
</body>
</html>
