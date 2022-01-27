<?php
session_start();
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
} else {
  //do nothing
}
$gmapsrc = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDALISmUV_DfGkHkHEwhveuKKJbvMA42sY&callback=initMap";

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rentr</title>
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/styles.css">
  <link type="text/css" rel="stylesheet" href="css/styles_listingpage.css">
  <script src="scripts/jscript_other.js"></script>
  <link rel="shortcut icon" type="image/png" href="css/images/rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
  <link rel="icon" type="image/png" href="css/images/rentr_logo_color.png"/> <!-- Biddr Logo Goes Here -->
</head>

<body>
  <div id="banner">
    <a href="index.php"><img id="logo" src="css/images/Rentr_white_text_logo.png"></a>  <!-- Biddr Logo Goes Here -->
  </div>

  <?php
  include 'navbar.php';
  ?>

  <?php
  include 'connection.php';
  include 'tenantapp_form.php';
  $propID = "";
  $propID = $_GET['id'];
  $propertyQuery = "SELECT house_prop.*, propertylocation.* FROM house_prop, propertylocation  WHERE house_prop.propertyid = '".$propID."' AND propertylocation.propertyid = house_prop.propertyid AND house_prop.verified = 'true'";
  $retval = mysqli_query($conn, $propertyQuery);
  if($retval == true) {

    if(mysqli_num_rows($retval) > 0){
      //var_dump(mysqli_num_rows($retval));
      while($row = mysqli_fetch_array($retval)){

        $propMapAddr = $row['streetaddress'].','.$row['suburb'].','.$row['city'];
        //echo $propMapAddr;

        echo '<div id="listingsearchbar">';
        include "searchbar.php";
        echo '</div>';
        echo '
        <div id="linkbar"><a href="proprent_page.php">Properties for rent</a> > <a href="proprent_page.php">Residential</a> > <a href="">'.$row["listingtitle"].'</a></div>
        <div id="propbox">
        <div id="titlerow">
        <div id="listtitle">'.$row["listingtitle"].'</div>
        <div id="listid">Listing ID:' .$row["propertyid"].'</div>
        </div>

        <div id="propertyDetails">
        <div id="pricerow">
        <div id="listprice">Minimum Price: $'.$row["listingprice"].' per Week</div>';
        if(isset($user_name)){
          echo '<div id="listbtn"><button id="appbtn" onclick="openNav()" class="btnApply">Apply Now</button></div>';
        } else {
          echo '<div id="listbtn"><button id="appbtn" onclick="loginNotify()" class="btnApply">Apply Now</button></div>
          <div id="popupNotify" class="modal">
          <div class="modal-content">
          <span class="close"></span>
          <p>You must be logged in to apply for this property. Click <a href="login.php">here</a> to login.</p>
          </div>
          </div>
            ';
        }
        echo '</div>

        <div id="propertyImage">
        <div id="propImg"></div>
        </div>

        <div id="daterow">
        <div id="listdate">Available: '.$row["availabledate"].'</div>
        <div id="buildtype">Building: '.$row["buildingtype"].'</div>
        </div>

        <div id="addressrow">
        <div id="propertyaddress">
        <div id="propaddr">Address: '.$row["streetaddress"].'</div>
        <div id="propsub">Suburb: '.$row["suburb"].'</div>
        <div id="proppost">Postcode: '.$row["postcode"].'</div>
        <div id="propcity">City: '.$row["city"].'</div>
        </div>
        </div>

        <div id="propDetailsRow">
        <div id="beds">Beds: ' .$row["bedrooms"].'</div>
        <div id="baths">Baths: ' .$row["bathrooms"].'</div>
        <div id="furnished">Furnished: ' .$row["furnished"].'</div>
        <div id="parking">Parking: ' .$row["parking"].'</div>
        <div id="petsok">Pets: ' .$row["pets"].'</div>
        <div id="smoking">Smokers: ' .$row["smokers"].'</div>
        </div>

        <div id="listdesc">' .$row["description"].'</div>
        <div id="map"></div>
        <div id="agentbox">
        <div id="listrating">Listing Popularity:</div>
        <div id="listshowing">Contact agent to book a showing: ';
        include "contactagent_form.php";
        echo '
        </div>
        </div>
        </div>
        </div>
        ';
      }
    }
  }

  include 'banner.php';

  ?>

  <script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: {lat: -36.848, lng: 174.763}
    });
    var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, map);
  }

  function geocodeAddress(geocoder, resultsMap) {
    var address = "<?php echo $propMapAddr; ?>"

    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: -36.848, lng: 174.763}
        });
        //alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDALISmUV_DfGkHkHEwhveuKKJbvMA42sY&callback=initMap"></script>
