<?php
if(isset($_SESSION['userName'])){
  //echo $_SESSION['userName'];
  $user_name = $_SESSION['userName'];
  if(isset($_SESSION['agentid'])){
    $agentid = $_SESSION['agentid'];
    //var_dump($agentid);
    //echo 1;
    if(isset($_SESSION['emailaddr'])) {
      $emailaddr = $_SESSION['emailaddr'];
    } else {
      echo "You must be logged in to create a listing";
    }
  } else {
    echo "You must be logged in to create a listing";
  }
  //echo 2;
  //echo $agentid;
} else {
  //do nothing
}

// SERVER CONNECTION
include 'connection.php';

// define variables and set to empty values
$list_title = $listrent = $buildtype = $dateavailable = $furnished = $bedrooms = $bathrooms = $pets = $smokers = $parking = $address = $suburb = $postcode = $city = $description = $hash = "";
// contact details
$contactnum = $contactemail = "";
$propId = "";
//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //check each input
  foreach($_POST as $key=>$value) {
    if(empty($_POST[$key])) {
      $error_message = "All Fields are required";
      break;
    }
  }
  // input validations
  if((validStrLen($_POST['listingtitle'], 1, 64)) == TRUE){
    //var_dump(filter_var($_POST["userEmail"],FILTER_VALIDATE_EMAIL));
    //echo "1a";
    if((validStrLen($_POST["listingprice"], 2, 5)) == TRUE){
      //var_dump(filter_var($_POST["userEmail"],FILTER_VALIDATE_EMAIL));
      if((validStrLen($_POST["buildingtype"], 4, 11)) == TRUE){
        //var_dump(validStrLen($_POST["userName"], 3, 14));
        if(isset($_POST["furnished"])){
          //echo "1b";
          if((validStrLen($_POST["furnished"], 2, 3)) == TRUE){
            //var_dump(validStrLen($_POST["password"], 8, 64));
            if((validStrLen($_POST["bedrooms"], 1, 2)) == TRUE){
              //var_dump(validStrLen($_POST["postcode"], 4, 6));
              if((isRealDate($_POST["availabledate"])) == TRUE){
                //var_dump((isRealDate($_POST["dob"])));
                if((validStrLen($_POST["bathrooms"], 1, 2)) == TRUE){

                  if(isset($_POST["pets"])){
                    //echo "1c";
                    if((validStrLen($_POST["pets"], 2, 3)) == TRUE){

                      if((validStrLen($_POST["smokers"], 2, 3)) == TRUE){

                        if((validStrLen($_POST["parking"], 1, 64)) == TRUE){

                          if((validStrLen($_POST["listingaddr"], 5, 64)) == TRUE){

                            if((validStrLen($_POST["postcode"], 4, 4)) == TRUE){

                              if((validStrLen($_POST["city"], 1, 64)) == TRUE){

                                if((validStrLen($_POST["description"], 40, 1500)) == TRUE){

                                  if((validStrLen($_POST["suburb"], 1, 64)) == TRUE){

                                    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                                      //echo 55;
                                      //your site secret key
                                      $secret = '6LeXJyUUAAAAANiE6k4hRlzNnTCp8nfPJre2jDjZ';
                                      //get verify response data
                                      $verifyResponse = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
                                        //var_dump($verifyResponse);
                                        if($verifyResponse->success) {
                                          //echo "2a";
                                          //$list_title = $listrent = $buildtype = $dateavailable = $furnished = $bedrooms = $bathrooms = $pets = $parking = $address = $suburb = $postcode = $city = $description = "";
                                          $list_title = $conn->real_escape_string(filter_var($_POST["listingtitle"], FILTER_SANITIZE_STRING));
                                          $listrent = $conn->real_escape_string(filter_var($_POST["listingprice"], FILTER_SANITIZE_STRING));
                                          $buildtype = $conn->real_escape_string(filter_var($_POST["buildingtype"], FILTER_SANITIZE_STRING));
                                          $dateavailable = $conn->real_escape_string($_POST["availabledate"]);
                                          $furnished = $conn->real_escape_string(filter_var($_POST["furnished"], FILTER_SANITIZE_STRING));
                                          $bedrooms = $conn->real_escape_string(filter_var($_POST["bedrooms"], FILTER_SANITIZE_STRING));
                                          $bathrooms = $conn->real_escape_string(filter_var($_POST["bathrooms"], FILTER_SANITIZE_STRING));
                                          $pets = $conn->real_escape_string(filter_var($_POST["pets"], FILTER_SANITIZE_STRING));
                                          $smokers = $conn->real_escape_string(filter_var($_POST["smokers"], FILTER_SANITIZE_STRING));
                                          $parking = $conn->real_escape_string(filter_var($_POST["parking"], FILTER_SANITIZE_STRING));
                                          $address = $conn->real_escape_string(filter_var($_POST["listingaddr"], FILTER_SANITIZE_STRING));
                                          $suburb = $conn->real_escape_string(filter_var($_POST["suburb"], FILTER_SANITIZE_STRING));
                                          $postcode = $conn->real_escape_string(filter_var($_POST["postcode"], FILTER_SANITIZE_STRING));
                                          $city =  $conn->real_escape_string(filter_var($_POST["city"], FILTER_SANITIZE_STRING));
                                          $description =  $conn->real_escape_string(filter_var($_POST["description"], FILTER_SANITIZE_STRING));

                                          $hash = md5(rand(10000000,19999999) + rand(10000000,19999999));

                                          //contact details
                                          //$contactnum = "";
                                          //$contactemail = "";

                                          //query
                                          $query =	"INSERT INTO house_prop (agentid, listingtitle, listingprice, buildingtype, availabledate, bedrooms, bathrooms, pets, smokers, furnished, parking, description, hash)
                                          VALUES	('".$agentid."','".$list_title."', '".$listrent."', '".$buildtype."','".$dateavailable."','".$bedrooms."', '".$bathrooms."', '".$pets."', '".$smokers."','".$furnished."', '".$parking."', '".$description."', '".$hash."');";

                                          $queryploc = "INSERT INTO propertylocation (propertyid, streetaddress, suburb, postcode, city) VALUES ((select propertyid from house_prop where agentid= '".$agentid."'AND hash= '".$hash."' ),'".$address."', '".$suburb."', '".$postcode."', '".$city."');";
                                          //uploadImages($hash);
                                          //echo "2b";
                                          if($conn->query($query) === true) {
                                            if($conn->query($queryploc) === true) {
                                              //echo "2c";
                                              verifyEmail($emailaddr, $hash);
                                              $success_message = "Listing created! You will be redirected shortly...";
                                              unset($_POST);
                                              //add redirect
                                              //echo header("refresh:5;url=index.php");
                                            }	else {
                                              // set Error returns here ************************
                                              $error_message = "Listing creation unsuccessful.";
                                              echo "Error: " . $queryploc . "<br>" . $conn->error;
                                              echo " Problem in listing. Try Again!";
                                            }
                                          } else {
                                            // set Error returns here ************************
                                            $error_message = "Listing creation unsuccessful.";
                                            echo "Error: " . $query . "<br>" . $conn->error;
                                            echo " Problem in listing. Try Again!";
                                          }
                                        }
                                      } else {
                                        $error_message = " Please check all fields before submitting your listing.";
                                      }
                                    } else {
                                      $error_message = "Please enter a suburb.";
                                    }
                                  } else {
                                    $error_message = "Description must be 40-1500 characters.";
                                  }
                                } else {
                                  $error_message = "Please enter a valid city.";
                                }
                              } else {
                                $error_message = "Please enter a valid NZ postcode.";
                              }
                            } else {
                              $error_message = "Please enter a valid address.";
                            }
                          } else {
                            $error_message = "Please enter some information on the property's parking.";
                          }
                        } else {
                          $error_message = "Please select whether the property allows smokers.";
                        }
                      } else {
                        $error_message = "Please select whether the property allows pets.";
                      }
                    } else {
                      $error_message = "Please select whether the property allows pets.";
                    }
                  } else {
                    $error_message = "Please enter the number of bathrooms.";
                  }
                } else {
                  $error_message = "Please enter a valid date of birth; dd/mm/yyyy.";
                }
              } else {
                $error_message = "Please enter the number of bedrooms.";
              }
            } else {
              $error_message = "Please select whether the property is furnished.";
            }
          } else {
            $error_message = "Please select whether the property is furnished.";
          }
        } else {
          $error_message = "Please select a building type.";
        }
      } else {
        $error_message = "Please enter the minimum rental price per week.";
      }
    } else {
      $error_message = "Please enter a valid listing title.";
    }

    //end of post conditional =====================================================
  }
  // upload multiple images to upload directory and insert into image_table in database
  function uploadImages($hash){

    include 'connection.php';
    // upload code ==============================================================
    $upload_dir = "/upload";
    foreach($_FILES['propertyImages']['name'] as $file => $error) {
      //print_r($file);
      if($error == UPLOAD_ERR_OK) {

        $tmp_name = $_FILES['propertyImages']['tmp_name'][$file];
        $imagename = basename($_FILES["propertyImages"]["name"][$file]);
        $check = getimagesize($_FILES['propertyImages']['tmp_name'][$file]);
        $imageFileType = pathinfo($imagename, PATHINFO_EXTENSION);

        if($check !== false) {
          echo 33;
          if(file_exists("upload/")){
            echo 55;

            $retval = move_uploaded_file($tmp_name, ".$upload_dir/$imagename.");
            //var_dump($retval);
            //query
            $insertquery = "INSERT INTO image_table (listingid, imagename, imagecontent) VALUES	('".$hash."','".$imagename."', '".$tmp_name."');";

            $retval2 = mysqli_query($conn1, $insertquery);
            //var_dump($retval2);

          } else {
            $error_message = "File already exists.";
          }
        } else {
          $error_message = "File is not an image.";
        }
      }
    }
    $conn1->close();
  }

  //check length of inputs
  function validStrLen($str, $min, $max){
    $len = strlen($str);
    if($len < $min){
      //$error_message = "Field Name is too short, minimum is $min characters ($max max)";
      return FALSE;
    }
    elseif($len > $max){
      //$error_message = "Field Name is too long, maximum is $max characters ($min min).";
      return FALSE;
    }
    return TRUE;
  }

  //check date is proper format
  function isRealDate($date){

    list($day, $month, $year) = explode('/', $date);
    //echo "<li>$year</li>";
    //echo "<li>$month</li>";
    //echo "<li>$day</li>";
    if (false === checkdate($month, $day, $year))	{
      //echo 2;
      //echo (checkdate($day, $month, $year));
      //var_dump(checkdate($day, $month, $year));
      return false;
    } elseif(validStrLen($date, 10, 10) == true) {
      //echo 3;
      return true;
    }
    //echo 4;
    return true;
  }

  //change for listing details etc...
  function verifyEmail($emailaddr, $hash){
    $propId = getPropId($hash);
    //var_dump($propId);
    $to = $subject = $message = $headers = "";
    $to = $emailaddr; // Send email to our user
    $subject = 'New Listing | Verification'; // Give the email a subject
    $message = '

    Thanks for using Rentr.co.nz to list your property.
    Your listing has been created and will be published after pressing the url below.

    ------------------------
    Listing ID: '.$propId.'
    ------------------------

    Please click this link to publish your listing:
    http://localhost/Biddr/verifylisting.php?email='.$emailaddr.'&hash='.$hash.'

    '; // Our message above including the link

    $headers = 'From:noreply@rentr.co.nz' . "\r\n"; // Set from
    mail($to, $subject, $message, $headers);
  }

  function getPropId($hash){
    include 'connection.php';
    $propId = $querypid = "";
    $querypid = "SELECT propertyid FROM house_prop WHERE hash = '".$hash."'";
    $pid = mysqli_query($conn,$querypid);
    if(mysqli_num_rows($pid) > 0){
      //var_dump(mysqli_num_rows($pid));
      while($row = mysqli_fetch_array($pid)){
        $propId = $row['propertyid'];
        //var_dump($propId);
      }
    }
    return $propId;
  }

  $conn->close();
  ?>

  <form name="frmRegistration" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" runat="server">
    <table border="0" align="center" class="listing-table">

      <tr><td colspan="2"><?php if(!empty($success_message)) { ?>
        <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
        <?php } ?></td></tr>

        <tr><td colspan="2"><?php if(!empty($error_message)) { ?>
          <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
          <?php } ?></td></tr>

          <div id="proplisttxt" class="titleblock">Property Listing</div>
          <div id="listingdetails">
            <tr>
              <td>Listing Title</td>
              <td><input type="text" class="demoInputBox" name="listingtitle" value="<?php if(isset($_POST['listingtitle'])) echo $_POST['listingtitle']; ?>" required></td>
            </tr>

            <tr>
              <td>Rent per week ($NZD)</td>
              <td><input type="number" class="demoInputBox" name="listingprice" title="Must be in $NZD." value="<?php if(isset($_POST['listingprice'])) echo $_POST['listingprice']; ?>" required></td>
            </tr>

            <tr>
              <td>Building Type</td>
              <td>
                <input type="radio" name="buildingtype" value="Apartment" checked <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Apartment") { ?>checked<?php  } ?>> Apartment
                <input type="radio" name="buildingtype" value="House" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="House") { ?>checked<?php  } ?>> House
                <input type="radio" name="buildingtype" value="Townhouse" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Townhouse") { ?>checked<?php  } ?>> Townhouse
                <input type="radio" name="buildingtype" value="Unit" <?php if(isset($_POST['buildingtype']) && $_POST['buildingtype']=="Unit") { ?>checked<?php  } ?>> Unit
              </td>
            </tr>

            <tr>
              <td>Available Date</td>
              <td><input type="text" class="demoInputBox" name="availabledate" title="dd/mm/yyyy" maxlength="10" value="<?php if(isset($_POST['availabledate'])) echo $_POST['availabledate']; ?>" required></td>
            </tr>

            <tr>
              <td>Furnished</td>
              <td>
                <input type="radio" name="furnished" value="Yes" <?php if(isset($_POST['furnished']) && $_POST['furnished']=="Yes") { ?>checked<?php  } ?>> Yes
                <input type="radio" name="furnished" value="No" checked<?php if(isset($_POST['furnished']) && $_POST['furnished']=="No") { ?>checked<?php  } ?>> No
              </td>
            </tr>

            <tr>
              <td>Number of bedrooms</td>
              <td><input type="number" class="demoInputBox" maxlength="2" name="bedrooms" value="<?php if(isset($_POST['bedrooms'])) echo $_POST['bedrooms']; ?>" required></td>
            </tr>

            <tr>
              <td>Number of bathrooms</td>
              <td><input type="number" class="demoInputBox" maxlength="2" name="bathrooms" value="<?php if(isset($_POST['bathrooms'])) echo $_POST['bathrooms']; ?>" required></td>
            </tr>

            <tr>
              <td>Pets Allowed</td>
              <td>
                <input type="radio" name="pets" value="Yes" <?php if(isset($_POST['pets']) && $_POST['pets']=="Yes") { ?>checked<?php  } ?>> Yes
                <input type="radio" name="pets" value="No" checked<?php if(isset($_POST['pets']) && $_POST['pets']=="No") { ?>checked<?php  } ?>> No
              </td>
            </tr>

            <tr>
              <td>Smoking Allowed</td>
              <td>
                <input type="radio" name="smokers" value="Yes" <?php if(isset($_POST['smokers']) && $_POST['smokers']=="Yes") { ?>checked<?php  } ?>> Yes
                <input type="radio" name="smokers" value="No" checked<?php if(isset($_POST['smokers']) && $_POST['smokers']=="No") { ?>checked<?php  } ?>> No
              </td>
            </tr>

            <tr>
              <td>Parking</td>
              <td><input type="text" class="demoInputBox" name="parking" value="<?php if(isset($_POST['parking'])) echo $_POST['parking']; ?>" required></td>
            </tr>

            <tr>
              <td>Address</td>
              <td><input type="text" class="demoInputBox" name="listingaddr" value="<?php if(isset($_POST['listingaddr'])) echo $_POST['listingaddr']; ?>" required></td>
            </tr>

            <tr>
              <td>Suburb</td>
              <td><input type="text" class="demoInputBox" name="suburb" value="<?php if(isset($_POST['suburb'])) echo $_POST['suburb']; ?>" required></td>
            </tr>

            <tr>
              <td>City</td>
              <td><input type="text" class="demoInputBox" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>" required></td>
            </tr>

            <tr>
              <td>Postcode</td>
              <td><input type="number" class="demoInputBox" name="postcode" maxlength="4" value="<?php if(isset($_POST['postcode'])) echo $_POST['postcode']; ?>" required></td>
            </tr>

            <tr>
              <td>Description</td>
              <td>
                <textarea id="description" type="text" rows="10" cols="60" class="demoInputBox" name="description" autocomplete="on" required
                ><?php if(isset($_POST['description'])) { echo htmlentities($_POST['description']); }?></textarea>
              </td>
            </tr>

            <tr>
              <td>Upload property photos:</td>
              <td>
                <input id="propImages" type="file" name="propImages[]" multiple="true" class="inputfile" onchange="resetImgtd();previewFiles();"/>
                <label for="propImages">Upload Photos</label>
                <button id="rmv1" type="button" class="btnRFiles" onclick="clearall();">Remove Files</button>
                <button id="rmvchecked" type="button" class="btnRFiles" onclick="clearchecked();">Remove Checked Files</button>
              </td>
            </tr>


            <tr>
              <td class="tdblockleft">Selected photos: </td>
              <td class="tdblockright"><div id="preview"></div></td>
            </tr>


            <tr>
              <td><div class="g-recaptcha" data-sitekey="6LeXJyUUAAAAAB5F7_NIGl4hP5zxF2bUhVJAF69d"></div><td>
            </tr>

              <tr>
                <td colspan=2 class="titleblock">
                  <input type="checkbox" name="terms" required> I accept <a href="">Terms and Conditions</a><input type="submit" href="" name="create-listing" value="Create Listing" class="btnSubmit">
                </td>
              </tr>
            </div>
          </table>
        </form>
