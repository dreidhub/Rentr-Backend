<?php
session_start();
//$action = $_REQUEST['action'];
//echo $_SESSION['pwHash'];
//echo $_GET['hash'];
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

  <div id="resetpasswordform">
    <h2>Reset Password:</h2>
    <p class="titleblock">Reset password for email address: <?php echo $_GET['email']; ?></p>
    <form name="frmRegistration" method="post" action="" enctype="multipart/form-data" class="resetform">
      <table border="0" align="center" class="password-table">

        <?php if(!empty($success_message)) { ?>
          <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
          <?php } ?>

          <?php if(!empty($error_message)) { ?>
            <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
            <?php } ?>

            <tr>
              <td>New Password:</td>
              <td><input type="password" class="demoInputBox" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" required/></td>
            </tr>

            <tr>
              <td>Confirm Password:</td>
              <td><input type="password" class="demoInputBox" name="confirm_password" value="<?php if(isset($_POST['confirm_password'])) echo $_POST['confirm_password']; ?>" required/></td>
            </tr>

            <tr>
              <td><input type="submit" href="" name="send-message" value="Reset Password" class="btnRFiles"/></td>
            </tr>

          </table>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if(isset($_POST['password']) && !empty($_POST['password']) AND isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
            if($_SESSION['pwHash'] == $_GET['hash']) {
              if($_POST['confirm_password'] == $_POST['password']){
                if(filter_var($_GET["email"],FILTER_VALIDATE_EMAIL) != false){
                  //echo 1;
                  include 'connection.php';

                  //get emailaddr
                  $emailaddr = $_GET['email'];
                  $passupdated = md5($_POST['password']);
                  $query = "UPDATE users SET password = '".$passupdated."' WHERE id IN (SELECT id FROM usercontact WHERE contactemail= '".$emailaddr."')";
                  $retval = mysqli_query($conn,$query);
                  //var_dump($retval);
                  $conn->close();
                  if($retval === true){
                    echo "Your password has been changed, you can now login with your new password.\n";
                    echo "You will be redirected to the login page shortly...";
                    session_destroy();
                    echo header("refresh:5;url=login.php");
                  }
                } else {
                  echo '<div class="error-message">Email entered is not valid.</div>';
                }
              } else {
                // Invalid approach
                echo '<div class="error-message">Passwords must be matching.</div>';
              }
            } else {
              // Invalid approach
              echo '<div class="error-message">Invalid approach, please use the link that has been send to your email.</div>';
            }
          } else {
            // Invalid approach
            echo '<div class="error-message">Invalid approach, please use the link that has been send to your email.</div>';
          }
        }
        ?>
      </div>

      <?php include 'banner.php'; ?>
    </body>
    </html>
