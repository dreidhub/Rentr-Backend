<?php
//javascript:alert(grecaptcha.getResponse());
if(!isset($_REQUEST['action'])){ ?>
  <form name="frmRegistration" method="post" action="" enctype="multipart/form-data" class="formContact">
    <table border="0" align="center" class="demo-table">

      <?php if(!empty($success_message)) { ?>
        <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
        <?php } ?>

        <?php if(!empty($error_message)) { ?>
          <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
          <?php } ?>

          <tr><td><h3>Contact us</h3></td></tr>

          <tr>
            <td>Contact Name:</td>
            <td><input type="text" class="demoInputBox" name="contactname" value="<?php if(isset($_POST['contactname'])) echo $_POST['contactname']; ?>" required/></td>
          </tr>

          <tr>
            <td>Contact Email:</td>
            <td><input type="text" class="demoInputBox" name="contactemail" value="<?php if(isset($_POST['contactemail'])) echo $_POST['contactemail']; ?>" required/></td>
          </tr>

          <tr>
            <td>Message:</td>
            <td><textarea rows="6" cols="40" class="demoInputBox" name="contactmessage" value="<?php if(isset($_POST['contactmessage'])) echo $_POST['contactmessage']; ?>" required></textarea>
            </td>
          </tr>
          <tr>
            <td><div class="g-recaptcha" data-sitekey="6LeVJyUUAAAAAMTdWrUwTk0va1VaJuPCJ3zs0wkK"></div></td>
            <td><input type="submit" href="" name="send-message" value="Send Message" class="btnSubmit"/></td>
          </tr>

        </table>
      </form>
      <?php
}
?>
