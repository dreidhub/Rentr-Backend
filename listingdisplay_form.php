<?php
include 'connection.php';

$getEachProp = "SELECT house_prop.*, propertylocation.* FROM house_prop, propertylocation  WHERE propertylocation.propertyid = house_prop.propertyid AND house_prop.verified = 'true'";
$retval = mysqli_query($conn, $getEachProp);
if($retval == true) {
  ?>
  <div id="proplistingSmall">
  <table border="0" align="center" class="property-table">
        <?php
        $row_count = 0;
        $col_count = 0;
        if(mysqli_num_rows($retval) > 0){
          //var_dump(mysqli_num_rows($retval));
          while($row = mysqli_fetch_array($retval)){
            if(($row_count % 4) == 0){
              echo "<tr>";
              $col_count = 1;
            }
            //var_dump($row);
            echo '
            <td>
              <a id="listinglink" href="listing.php?id='.$row['propertyid'].'">
                <div id="propbox">
                  <div id="propertyImage">
                    <div id="propImg"></div>
                  </div>
                  <div id="propertyDetails">
                    <div id="titlepricerow">
                      <div id="listtitle">'.$row["listingtitle"].'</div>
                      <div id="listprice">P/W: $'.$row["listingprice"].'</div>
                    </div>
                    <div id="addressrow">
                      <div id="propertyaddress">
                        <div id="propsub">'.$row["suburb"].',&nbsp</div>
                        <div id="propcity">'.$row["city"].'</div>
                      </div>
                    </div>
                    <div id="daterow">
                      <div id="listdate">Available: '.$row["availabledate"].'</div>
                      <div id="buildtype">'.$row["buildingtype"].'</div>
                    </div>
                    <div id="propDetailsRow">
                    <div id="beds"><img id="bed-icon" src="css/images/rentr_bed_128.png" alt=" Bedrooms" title="Bedrooms">' .$row["bedrooms"].'</div>
                    <div id="baths"><img id="bath-icon" src="css/images/rentr_bath_128.png" alt=" Bathrooms" title="Bathrooms">' .$row["bathrooms"].'</div>
                    <div id="petsok"><img id="pet-icon" src="css/images/rentr_pet_128.png" alt=" Pets" title="Pets Allowed">' .$row["pets"].'</div>
                    <div id="smoking"><img id="smoke-icon" src="css/images/rentr_smoking_128.png" alt=" Smokers" title="Smokers Allowed">' .$row["smokers"].'</div>
                    </div>
                  </div>
                </div>
              </a>
            </td>
            ';
            if($col_count == 4){
              echo "</tr>";
            }
            $row_count++;
            $col_count++;
          }
        } ?>
  </table>
  </div>
  <?php
}
$conn->close();
?>
