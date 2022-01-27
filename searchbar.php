<?php

$Northland = "01, 02, 03, 04,0 5";
$Auckland = "06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26";
$Waikato = "32,33,34,35,36,37,38";
$BOP = "30,31";
$Gisborne = "40";
$HB = "41,42";
$Taranaki = "43,46";
$MW = "39,44,45,47,48,49,55";
$Wellington = "50,51,52,53,57,58,60,61,62,64,69";
$Tasman = "70,71";
$Marl = "72";
$WC = "78";
$Canterbury = "73,74,75,76,77,79,80,81,82,84,85,85,88,89";
$Otago = "90,92,93,94,95";
$Southland = "96,97,98";

$query = "";
$raw_results = "SELECT * FROM articles  WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')";

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $initquery = "SELECT * FROM house_prop, propertylocation WHERE house_prop.propertyid = propertylocation.propertyid";
  //&& $_POST['region'] != 0
  if(isset($_POST['region']) ){
    $region = $conn->real_escape_string(filter_var($_POST["region"], FILTER_SANITIZE_STRING));
    $regionquery = "";
    $regionquery = " AND (regioncode.region LIKE '%".$region."%')";
    $initquery .= $regionquery;

    //var_dump($initquery);
  }
  if(isset($_POST['suburb'])){
    $suburb = $conn->real_escape_string(filter_var($_POST["suburb"], FILTER_SANITIZE_STRING));
    $suburbquery = "";
    $suburbquery .= " AND ";
  }
  if(isset($_POST['listingpricemin'])){
    $minprice = $conn->real_escape_string(filter_var($_POST["listingpricemin"], FILTER_SANITIZE_STRING));
    $pricequery = "";
    $pricequery = " AND ";
  }
  if(isset($_POST['listingpricemax'])){
    $maxprice = $conn->real_escape_string(filter_var($_POST["listingpricemax"], FILTER_SANITIZE_STRING));
    $maxpricequery = "";
    $maxpricequery = " AND ";
  }
  if(isset($_POST['buildingtype'])){
    $buildtype = $conn->real_escape_string(filter_var($_POST["buildingtype"], FILTER_SANITIZE_STRING));
    $buildtypequery = "";
    $buildtypequery = " AND ";
  }
  if(isset($_POST['availabledate'])){
    $date = $conn->real_escape_string(filter_var($_POST["availabledate"], FILTER_SANITIZE_STRING));
    $datequery = "";
    $datequery = " AND ";
  }
  if(isset($_POST['furnished'])){
    $furnished = $conn->real_escape_string(filter_var($_POST["furnished"], FILTER_SANITIZE_STRING));
    $furnishedquery = "";
    $furnishedquery = " AND ";
  }
  if(isset($_POST['bedroomsmin'])){
    $bedmin = $conn->real_escape_string(filter_var($_POST["bedroomsmin"], FILTER_SANITIZE_STRING));

  }
  if(isset($_POST['bedroomsmax'])){
    $bedmax = $conn->real_escape_string(filter_var($_POST["bedroomsmax"], FILTER_SANITIZE_STRING));

  }
  if(isset($_POST['bathroomsmin'])){
    $bathmin = $conn->real_escape_string(filter_var($_POST["bathroomsmin"], FILTER_SANITIZE_STRING));

  }
  if(isset($_POST['bathroomsmax'])){
    $bathmax = $conn->real_escape_string(filter_var($_POST["bathroomsmax"], FILTER_SANITIZE_STRING));

  }
  if(isset($_POST['pets'])){
    $petsok = $conn->real_escape_string(filter_var($_POST["pets"], FILTER_SANITIZE_STRING));

  }
  if(isset($_POST['description'])){
    $desc = $conn->real_escape_string(filter_var($_POST["description"], FILTER_SANITIZE_STRING));
    $descquery = "";
    $descquery .= " AND description LIKE '%".$desc."%'";
  }

}

?>

<form name="frmSearch" method="post" action="proprent_page.php" enctype="multipart/form-data">
  <table border="0" align="center" class="search-table">

    <?php if(!empty($success_message)) { ?>
      <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
      <?php } ?>

      <?php if(!empty($error_message)) { ?>
        <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
        <?php } ?>

        <div id="searchbar">
          <tr>
            <td><h3>Search Properties</h3></td>
          </tr>

          <tr>
            <td>Region</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="region" value="<?php if(isset($_POST['region'])) echo $_POST['region']; ?>">
                <option value="" title="All Regions">All Regions</option>
                <option value="2" title="Northland">Northland</option>
                <option value="3" title="Auckland">Auckland</option>
                <option value="4" title="Waikato">Waikato</option>
                <option value="5" title="Bay of Plenty">Bay of Plenty</option>
                <option value="6" title="Gisborne">Gisborne</option>
                <option value="7" title="Hawke's Bay">Hawke's Bay</option>
                <option value="8" title="Taranaki">Taranaki</option>
                <option value="9" title="Manawatu-Whanganui">Manawatu-Whanganui</option>
                <option value="10" title="Wellington">Wellington</option>
                <option value="11" title="Tasman">Tasman</option>
                <option value="12" title="Nelson">Nelson</option>
                <option value="13" title="Marlborough">Marlborough</option>
                <option value="14" title="West Coast">West Coast</option>
                <option value="15" title="Canterbury">Canterbury</option>
                <option value="16" title="Otago">Otago</option>
                <option value="17" title="Southland">Southland</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>District</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="district" value="<?php if(isset($_POST['district'])) echo $_POST['district']; ?>">
                <option value="All Districts" title="All Districts">All Districts</option>
                <option value="Auckland City" title="Auckland City">Auckland City</option>
                <option value="North Shore" title="North Shore">North Shore</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Suburb</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="suburb" value="<?php if(isset($_POST['suburb'])) echo $_POST['suburb']; ?>">
                <option value="All Suburbs" title="All Suburbs">All Suburbs</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Rent per week ($NZD)</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="listingpricemin" value="<?php if(isset($_POST['listingpricemin'])) echo $_POST['listingpricemin']; ?>">
                <option value="0" title="0">0</option>
                <option value="150" title="150">150</option>
                <option value="250" title="250">250</option>
                <option value="500" title="500">500</option>
                <option value="750" title="750">750</option>
                <option value="1000+" title="1000+">1000+</option>
              </select>
              to
              <select class="searchInputBox" name="listingpricemax" value="<?php if(isset($_POST['listingpricemax'])) echo $_POST['listingpricemax']; ?>">
                <option value="0" title="0">0</option>
                <option value="150" title="150">150</option>
                <option value="250" title="250">250</option>
                <option value="500" title="500">500</option>
                <option value="750" title="750">750</option>
                <option value="1000+" title="1000+">1000+</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>
              <div class="multiselect">
                <div class="selectbox" onclick="showDropdown()">
                  <select>
                    <option>Select building type:</option>
                  </select>
                  <div class="overselect"></div>
                </div>
                <div id="checkboxes">
                  <label><input type="checkbox" name="buildingtype" value="All types" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="All types") { ?>checked<?php  } ?>/> All types</label>
                  <label><input type="checkbox" name="buildingtype" value="Apartment" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Apartment") { ?>checked<?php  } ?>/> Apartment</label>
                  <label><input type="checkbox" name="buildingtype" value="House" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="House") { ?>checked<?php  } ?>/> House</label>
                  <label><input type="checkbox" name="buildingtype" value="Townhouse" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Townhouse") { ?>checked<?php  } ?>/> Townhouse</label>
                  <label><input type="checkbox" name="buildingtype" value="Unit" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Unit") { ?>checked<?php  } ?>/> Unit</label>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td>Date available from:</td>
          </tr>
          <tr>
            <td><input type="text" class="searchInputBox" name="availabledate" title="dd/mm/yyyy" maxlength="10" value="<?php if(isset($_POST['availabledate'])){echo $_POST['availabledate'];} else {echo date('m/d/y');} ?>"/>
            </td>
          </tr>

          <tr>
            <td>Furnished</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="furnished" value="Yes" <?php if(isset($_POST['furnished']) && $_POST['furnished']=="Yes") { ?>checked<?php  } ?>/> Yes
              <input type="checkbox" name="furnished" value="No"  <?php if(isset($_POST['furnished']) && $_POST['furnished']=="No") { ?>checked<?php  } ?>/> No
            </td>
            <td id="lastnameErr" class="errormsg"></td>
          </tr>

          <tr>
            <td>Bedrooms</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="bedroomsmin" value="<?php if(isset($_POST['bedroomsmin'])) echo $_POST['bedroomsmin']; ?>">
                <option value="1" title="1">1</option>
                <option value="2" title="2">2</option>
                <option value="3" title="3">3</option>
                <option value="4" title="4">4</option>
                <option value="5+" title="5+">5+</option>
              </select>
              to
              <select class="searchInputBox" name="bedroomsmax" value="<?php if(isset($_POST['bedroomsmax'])) echo $_POST['bedroomsmax']; ?>">
                <option value="1" title="1">1</option>
                <option value="2" title="2">2</option>
                <option value="3" title="3">3</option>
                <option value="4" title="4">4</option>
                <option value="5+" title="5+">5+</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Bathrooms</td>
          </tr>
          <tr>
            <td>
              <select class="searchInputBox" name="bathroomsmin" value="<?php if(isset($_POST['bathroomsmin'])) echo $_POST['bathroomsmin']; ?>">
                <option value="1" title="1">1</option>
                <option value="2" title="2">2</option>
                <option value="3" title="3">3</option>
                <option value="4" title="4">4</option>
                <option value="5+" title="5+">5+</option>
              </select>
              to
              <select class="searchInputBox" name="bathroomsmax" value="<?php if(isset($_POST['bathroomsmax'])) echo $_POST['bathroomsmax']; ?>">
                <option value="1" title="1">1</option>
                <option value="2" title="2">2</option>
                <option value="3" title="3">3</option>
                <option value="4" title="4">4</option>
                <option value="5+" title="5+">5+</option>
              </select>
            </td>
          </tr>

          <tr>
            <td>Pets Allowed</td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" name="pets" value="Yes"<?php if(isset($_POST['pets']) && $_POST['pets']=="Yes") { ?>checked<?php  } ?>/> Yes
              <input type="checkbox" name="pets" value="No" <?php if(isset($_POST['pets']) && $_POST['pets']=="No") { ?>checked<?php  } ?>/> No
            </td>
          </tr>


          <tr>
            <td>Description</td>
          </tr>
          <tr>
            <td><input type="text" class="searchInputBox" name="description" value="<?php if(isset($_POST['description'])) echo $_POST['description']; ?>"/></td>
          </tr>

          <tr>
            <td class="titleblock">
              <input type="submit" name="search-listings" value="Search Properties" class="btnRegister"/></td>
            </tr>
          </div>
        </table>
      </form>
