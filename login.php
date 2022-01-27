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

  <div id="loginsection" class="border">
    <h2>Login</h2>
    <div>
      <form name="frmRegistration" method="post" action="">
        <table border="0" align="center" class="demo-table">
          <tr>
            <td>
              Username: <input type="text" class="demoInputBox" name="userName" required>
            </td>
            <td>
              Password: <input type="password" class="demoInputBox" name="password" required>
            </td>
            <td>
              <input type="submit" href="" name="login-user" value="Login" class="btnLogin">
            </td>
          </tr>

          <?php
          include 'connection.php';

          if(isset($_POST['userName']) && !empty($_POST['userName']) AND isset($_POST['password']) && !empty($_POST['password'])){
            $user_name = $conn->real_escape_string($_POST['userName']);
            //echo $user_name;
            $password = md5($_POST['password']);
            //echo $password;
            //echo 1;
            $search = mysqli_query($conn,"SELECT username, password, verified FROM users WHERE username='".$user_name."' AND password='".$password."' AND verified='true'") or die(mysql_error());
            $match  = mysqli_num_rows($search);
            //echo $match;
            if($match > 0){
              //echo 3;
              //echo '<div class="success-messageFull">Login Complete, Welcome! Redirecting you now.</div>';
              if(!isset($_SESSION)) {
                session_start();
              } else {
                session_destroy();
                session_start();
              }

              //['cookie_lifetime' => 86400,] sets cookie for 1 day
              $_SESSION['userName'] = $user_name;
              $sqlquery = "SELECT users.id, usercontact.contactemail FROM users, usercontact WHERE users.id = usercontact.userID AND users.username='".$user_name."' AND users.verified='true';";
              //echo "Error: " . $sqlquery . "<br>" . $conn->error;
              //echo " Problem in registration. Try Again!";
              //return data of sql query
              $userid = mysqli_query($conn, $sqlquery);
              //var_dump($userid);
              //show error if search not completed
              if(!$userid){
                die("Error in login.");
                echo header("refresh:0;url=login.php");
              } else {
                //output data from query. assign agent id for listing creation etc.
                while($row = mysqli_fetch_assoc($userid)){
                  //print_r($row);
                  //echo $row['id'];
                  $_SESSION['agentid'] = $row["id"];
                  $_SESSION['emailaddr'] = $row['contactemail'];
                }

                echo header("refresh:0;url=profile_page.php");

              }
              //echo header("refresh:5;url=index.php");
              // Set cookie / Start Session / Start Download etc...
            }else{
              echo '<div class="error-messageFull">Login Failed! Please make sure that you enter the correct details and that you have activated your account.</div>';
            }
          }
          $conn->close();
          ?>
          <tr>
            <td><p><a href="passwordreset_page.php">Forgot password?</a></p></td>
            <td colspan="2"><p>Not a member yet? <a href="registeruser_page.php">Register here.</a></p></td>
            <tr>
            </table>

          </form>
        </div>
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
