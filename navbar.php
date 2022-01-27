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
