<?php

if(!isset($_REQUEST['action'])){ ?>
  <form name="frmRegistration" method="post" action="" enctype="multipart/form-data" class="resetform">
    <table border="0" align="center" class="pass-table">

      <?php if(!empty($success_message)) { ?>
        <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
        <?php } ?>

        <?php if(!empty($error_message)) { ?>
          <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
          <?php } ?>

          <tr>
            <td>Email Address:</td>
            <td><input type="text" class="demoInputBox" name="emailaddr" value="<?php if(isset($_POST['emailaddr'])) echo $_POST['emailaddr']; ?>" required/></td>
          </tr>

          <tr>
            <td><input type="submit" href="" name="send-message" value="Reset Password" class="btnRFiles"/></td>
          </tr>

        </table>
      </form>
      <?php
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if(isset($_POST['emailaddr']) && !empty($_POST['emailaddr'])){
        if(filter_var($_POST["emailaddr"],FILTER_VALIDATE_EMAIL) != false){
          $hash = md5(rand(0,9999) + rand(9999,69999));
          $emailaddr = $_POST['emailaddr'];
          $to      = $emailaddr; // Send email to our user
          $subject = 'Password Reset'; // Give the email a subject
          $message = '

          Please click the following link to reset your password or copy the URL to your browser:

          Please click this link to reset your password:
          http://localhost/Biddr/passwordreset.php?email='.$emailaddr.'&hash='.$hash.'

          '; // Our message above including the link

          $headers = 'From:noreply@rentr.co.nz' . "\r\n"; // Set from
          $retval = mail($to, $subject, $message, $headers);
          if($retval === true){
            echo "<div class='success-message'>Email Sent!</div>";
            session_destroy();
            session_start();
            $_SESSION['pwHash'] =  $hash;
          } else {
            echo "<div class='erroremail'>Error, email could not be sent.</div>";
          }
        } else {
          echo "<div class='erroremail'>You must enter a valid email address.</div>";
        }
      } else {
        echo "<div class='erroremail'>You must enter your email address to reset your password.</div>";
      }

    }

    ?>
