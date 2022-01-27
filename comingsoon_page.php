<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <link type="text/css" rel="stylesheet" href="css/styles_comingsoon.css">
  <link rel="shortcut icon" type="image/png" href="css/images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="icon" type="image/png" href="css/images/Rentr_logo_color.png"/> <!-- Rentr Logo Goes Here -->
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu">
  <script src="scripts/jscript_comingsoon.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
  <div id="openContact" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="content-overlay">
      <?php include 'comingsoon_contact.php'; ?>
    </div>
  </div>

  <div id="comingsoon">
    <div id="rentrimg"><img id="logo" src="css/images/Rentr_white_text_logo.png"></div>
    <div id="comingsoontxt">Coming Soon!</div>
    <p style="color:white;font-size:18px;">Stay up to date with our launch &amp; get exclusive pre-launch offers!</p>
    <div id="emailregister">
      <form name="frmRegistration" method="post" action="">
      <input placeholder="Enter your email" type="text" class="demoInputBox" name="emailregister" value="<?php if(isset($_POST['emailregister'])) echo $_POST['emailregister']; ?>"/>
      <input type="submit" href="" name="" value="Register" class="btnSubmit"/>
      </form>
    </div>
    <p style="color:white;font-size:24px;">"The <span style="font-weight:bold;">new</span> way to rent property."</p>
  </div>

  <div id="footer">
    <p class="copyright">
      &copy Rentr Ltd. 2017
    </p>
    <p id="nz100txt" class="nzowned">
      Proudly 100% New Zealand owned &amp; operated
    </p>
    <p id="contactbtn" class="contact">
      <button value="Contact us" onclick="openNav()">Contact us</button>
    </p>
    <p id="bloglink" class="contact">
      <a href="blog_page.php">Blog</a>
    </p>
    <p id="aboutlink" class="contact">
      <a href="about_page.php">About</a>
    </p>
  </div>


</body>
</html>

<?php




?>
