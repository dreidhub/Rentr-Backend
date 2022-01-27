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
  <script src="scripts/jscript_contact.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <link rel="shortcut icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
</head>
<body>
  <div id="banner">

    <img id="logo" src="css/images/Rentr_white_text_logo.png">  <!-- Rentr Logo Goes Here -->

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

  <div id="contactform">
    <h2>Contact us</h2>
    <?php
    include 'contactform.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //echo 55;
        //your site secret key
        $secret = '6LeVJyUUAAAAAOVXxaDxGEoTgholXB9PQfwJNItC';
        //get verify response data
        $verifyResponse = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
          //var_dump($verifyResponse);


          if($verifyResponse->success) {

            //echo 1;
            $name = $email = $message = "";
            $name = $_REQUEST['contactname'];
            $email = $_REQUEST['contactemail'];
            $message = $_REQUEST['contactmessage'];
            if (($name=="")||($email=="")||($message=="")) {
              echo "All fields are required, please fill <a href=\"\">the form</a> again.";
            } else {
              //echo 2;
              $from="From: $name<$email>\r\nReturn-path: $email";
              $subject="Message sent using your contact form";
              $retval = mail("messages@rentr.co.nz", $subject, $message, $from);
              //var_dump($retval);
              //echo "Email sent!";
            }
          }
          echo "Email sent!";
        } else {
          echo " Please check all fields before sending your message.";
        }
      }
      ?>
    </div>

    <?php include 'banner.php'; ?>
  </body>
  </html>
