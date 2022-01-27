<?php
session_start();
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
} else {
  //do nothing

}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Rentr</title>
    <link rel="stylesheet" href="css/styles_createlisting.css">
    <script src="scripts/jscript.js" language="javascript" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <link rel="shortcut icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
    <link rel="icon" type="image/png" href="images/Rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
  </head>
  <body>
    <div id="banner">

      <img id="logo" src="css/images/Rentr_white_text_logo.png">  <!-- Biddr Logo Goes Here -->

    </div>

    <?php include 'navbar.php';?>

    <div id="createlist">
      <h2>Create a listing</h2>
      <div>
        <?php
        if(isset($user_name)){
          include 'createlist_form.php';
        } else {
          echo '<div id="loginerr">You must be logged in to create a listing.</div>';
        }
        ?>
      </div>
    </div>

    <?php include 'banner.php'; ?>
  </body>
</html>
