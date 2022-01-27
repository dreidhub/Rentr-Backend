  <?php
  include 'connection.php';
  $propID = "";
  //$propID = $_GET['id'];
  $propertyQuery = "SELECT house_prop.*, propertylocation.*, users.* FROM house_prop, propertylocation, users WHERE users.username = '".$user_name."'AND propertylocation.propertyid = house_prop.propertyid ";
  $retval = mysqli_query($conn, $propertyQuery);
  //var_dump($retval);
  ?>
  <div id="profile-listings-table">
  <table border="0" align="center" class="property-table">

  <?php
  if($retval == true) {

    if(mysqli_num_rows($retval) > 0){
      //var_dump(mysqli_num_rows($retval));
      while($row = mysqli_fetch_array($retval)){
        echo '
        <tr>
        <td>
        <a id="listinglink" href="listing.php?id='.$row['propertyid'].'">
        <div id="propbox">

          <div id="propertyImage">
            <div id="propImg"></div>
          </div>

          <div id="propDetails">
            <div id="titlerow">
              <div id="listtitle">'.$row["listingtitle"].'</div>
            </div>

              <div id="listid">#' .$row["propertyid"].'</div>

              <div id="pricerow">
                <div id="listprice">$'.$row["listingprice"].' per Week</div>
              </div>

              <div id="addressrow">
                <div id="propaddr">'.$row["streetaddress"].", ".$row["suburb"].", ".$row["city"].", ".$row["postcode"].'</div>
              </div>

              <div id="daterow">
                <div id="listdate">Available: '.$row["availabledate"].'</div>
              </div>

              <div id="propDetailsRow">
                <div id="furnished">Furnished: ' .$row["furnished"].'</div>
                <div id="beds"><img id="bed-icon" src="css/images/rentr_bed_128.png" alt=" Bedrooms" title="Bedrooms">' .$row["bedrooms"].'</div>
                <div id="baths"><img id="bath-icon" src="css/images/rentr_bath_128.png" alt=" Bathrooms" title="Bathrooms">' .$row["bathrooms"].'</div>
                <div id="parking"><img id="parking-icon" src="css/images/rentr_parking_128.png" alt=" Parking" title="Offstreet Parking">' .$row["parking"].'</div>
                <div id="petsok"><img id="pet-icon" src="css/images/rentr_pet_128.png" alt=" Pets" title="Pets Allowed">' .$row["pets"].'</div>
                <div id="smoking"><img id="smoke-icon" src="css/images/rentr_smoking_128.png" alt=" Smokers" title="Smokers Allowed">' .$row["smokers"].'</div>
              </div>

          </div>

        </div>
        </a>
        </td>
        </tr>
        ';
      }
    }
  }
  ?>
</table>
</div>
