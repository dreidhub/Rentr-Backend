<?php
include 'connection.php';
$propID = "";
$propID = $_GET['id'];
$propertyQuery = "SELECT house_prop.*, propertylocation.* FROM house_prop, propertylocation  WHERE house_prop.propertyid = '".$propID."' AND propertylocation.propertyid = house_prop.propertyid AND house_prop.verified = 'true'";
$retval = mysqli_query($conn, $propertyQuery);
if($retval == true) {

  if(mysqli_num_rows($retval) > 0){
    //var_dump(mysqli_num_rows($retval));
    while($row = mysqli_fetch_array($retval)){
      $listprice = $row['listingprice'];
    }
  }
}

?>

<div id="TenantApp" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="content-overlay">
    <form name="frmRegistration" method="post" action="">
      <table border="0" align="center" class="demo-table">
        <tr><td><h2>Application Details</h2></td></tr>

        <?php if(!empty($success_message)) { ?>
          <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
          <?php } ?>

          <?php if(!empty($error_message)) { ?>
            <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
            <?php } ?>

            <div id="appOffer">

              <tr><td colspan=2><h3>Add offer</h3><td></tr>

                <tr>
                  <td>Minimum Weekly Rent: </td>
                  <td>$<?php echo $listprice; ?>.00 NZD</td>
                </tr>

                <tr>
                  <td>Your Offer</td>
                  <td><input type="text" title="$NZD" class="demoInputBox" name="tenantOffer" value="$<?php if(isset($_POST['tenantOffer'])) echo $_POST['tenantOffer']; ?>" required></td>
                </tr>

                <tr>
                  <td>Security Deposit</td>
                  <td><input type="text" title="$NZD" class="demoInputBox" name="tenantSecure" value="$<?php if(isset($_POST['tenantSecure'])) echo $_POST['tenantSecure']; ?>" required></td>
                </tr>

                <tr>
                  <td>Move-In Date</td>
                  <td><input type="text" title="dd/mm/yyyy" class="demoInputBox" name="tenantDate" value="<?php if(isset($_POST['tenantDate'])) echo $_POST['tenantDate'];?>" required></td>
                </tr>

                <tr>
                  <td>Term</td>
                  <td><select class="demoInputBox" name="tenantTerm" value="<?php if(isset($_POST['tenantTerm'])) echo $_POST['tenantTerm']; ?>" required>
                    <option value="6" title="Less than 6 Months">Less than 6 Months</option>
                    <option value="12" title="6 - 12 Months">6 - 12 Months</option>
                    <option value="18" title="12 - 18 Months">12 - 18 Months</option>
                    <option value="24" title="18 - 24 Months">18 - 24 Months</option>
                    <option value="32" title="Greater than 24 Months">Greater than 24 Months</option>
                  </td>
                </tr>

              </div>

              <div id="tenantdetails">
                <div id="employmentinfo">
                  <tr>
                    <td colspan=2><h3>Add employment</h3></td>
                  </tr>

                  <tr>
                    <div id="appEmploy">
                      <td>Status</td>
                      <td>
                        <input type="radio" name="employment" value="Employed" checked<?php if(isset($_POST['employment']) && $_POST['employment']=="Employed") { ?>checked<?php  } ?>>Employed
                        <input type="radio" name="employment" value="Student" <?php if(isset($_POST['employment']) && $_POST['employment']=="Student") { ?>checked<?php  } ?>>Student
                        <input type="radio" name="employment" value="Unemployed" <?php if(isset($_POST['employment']) && $_POST['employment']=="Unemployed") { ?>checked<?php  } ?>>Unemployed
                      </td>
                    </div>
                  </tr>

                  <tr>
                    <div id="appEmployer">
                      <td>Employer</td>
                      <td><input type="text" class="demoInputBox" name="employer" value="<?php if(isset($_POST['employer'])) echo $_POST['employer']; ?>" required></td>
                    </div>
                  </tr>

                  <tr>
                    <div id="appJobTitle">
                      <td>Title</td>
                      <td><input type="text" class="demoInputBox" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" required></td>
                    </div>
                  </tr>
                  <tr>
                    <div id="appJobTitle">
                      <td>Weekly Income (Optional)</td>
                      <td><input type="text" title="$NZD" class="demoInputBox" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" ></td>
                    </div>
                  </tr>
                </div>


                <div id="rentalhistory">
                  <tr><td colspan=2><h3>Add rental history</h3><td></tr>
                    <tr><td></td></tr>
                    <tr>
                      <td>Address</td>
                      <td><input type="text" class="demoInputBox" name="historyaddress" id="historyaddress" value="<?php if(isset($_POST['historyaddress'])) echo $_POST['historyaddress']; ?>" ></td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td><input type="text" class="demoInputBox" name="historycity" id="historycity" value="<?php if(isset($_POST['historycity'])) echo $_POST['historycity']; ?>" ></td>
                    </tr>
                    <tr>
                      <td>Weekly Rent (Optional)</td>
                      <td><input type="text" title="$NZD" class="demoInputBox" name="historyrent" id="historyrent" value="<?php if(isset($_POST['historyrent'])) echo $_POST['historyrent']; ?>"></td>
                    </tr>

                    <tr>
                      <td>Term</td>
                      <td>
                        <select class="demoInputBox" name="historyterm" value="<?php if(isset($_POST['historyterm'])) echo $_POST['historyterm']; ?>" >
                          <option value="6" title="Less than 6 Months">Less than 6 Months</option>
                          <option value="12" title="6 - 12 Months">6 - 12 Months</option>
                          <option value="18" title="12 - 18 Months">12 - 18 Months</option>
                          <option value="24" title="18 - 24 Months">18 - 24 Months</option>
                          <option value="32" title="Greater than 24 Months">Greater than 24 Months</option>
                        </td>
                      </tr>

                      <tr><td><input type="button" value="+ Add another property" onclick="showRentals();this.style.display = 'none';"/></td></tr>

                      <div id="prop2">
                        <tr class="hiddenprop2"><td></td></tr>
                        <tr class="hiddenprop2">
                          <td>Address</td>
                          <td><input type="text" class="demoInputBox" name="historyaddress2" id="historyaddress2" value="<?php if(isset($_POST['historyaddress2'])) echo $_POST['historyaddress2']; ?>" ></td>
                        </tr>
                        <tr class="hiddenprop2">
                          <td>City</td>
                          <td><input type="text" class="demoInputBox" name="historycity2" id="historycity2" value="<?php if(isset($_POST['historycity2'])) echo $_POST['historycity2']; ?>" ></td>
                        </tr>
                        <tr class="hiddenprop2">
                          <td>Weekly Rent (Optional)</td>
                          <td><input type="text" title="$NZD" class="demoInputBox" name="historyrent2" id="historyrent2" value="<?php if(isset($_POST['historyrent2'])) echo $_POST['historyrent2']; ?>"></td>
                        </tr>

                        <tr class="hiddenprop2">
                          <td>Term</td>
                          <td>
                            <select class="demoInputBox" name="historyterm2" value="<?php if(isset($_POST['historyterm2'])) echo $_POST['historyterm2']; ?>" >
                              <option value="6" title="Less than 6 Months">Less than 6 Months</option>
                              <option value="12" title="6 - 12 Months">6 - 12 Months</option>
                              <option value="18" title="12 - 18 Months">12 - 18 Months</option>
                              <option value="24" title="18 - 24 Months">18 - 24 Months</option>
                              <option value="32" title="Greater than 24 Months">Greater than 24 Months</option>
                            </td>
                          </tr>

                          <tr class="hiddenprop2"><td><input type="button" value="+ Add another property" onclick="showRentals2();this.style.display = 'none';"/></td></tr>
                        </div>

                        <div id="prop3">
                          <tr class="hiddenprop3"><td></td></tr>
                          <tr class="hiddenprop3">
                            <td>Address</td>
                            <td><input type="text" class="demoInputBox" name="historyaddress3" id="historyaddress3" value="<?php if(isset($_POST['historyaddress3'])) echo $_POST['historyaddress3']; ?>" ></td>
                          </tr>
                          <tr class="hiddenprop3">
                            <td>City</td>
                            <td><input type="text" class="demoInputBox" name="historycity3" id="historycity3" value="<?php if(isset($_POST['historycity3'])) echo $_POST['historycity3']; ?>" ></td>
                          </tr>
                          <tr class="hiddenprop3">
                            <td>Weekly Rent (Optional)</td>
                            <td><input type="text" title="$NZD" class="demoInputBox" name="historyrent3" id="historyrent3" value="<?php if(isset($_POST['historyrent3'])) echo $_POST['historyrent3']; ?>"></td>
                          </tr>

                          <tr class="hiddenprop3">
                            <td>Term</td>
                            <td>
                              <select class="demoInputBox" name="historyterm3" value="<?php if(isset($_POST['historyterm3'])) echo $_POST['historyterm3']; ?>" >
                                <option value="6" title="Less than 6 Months">Less than 6 Months</option>
                                <option value="12" title="6 - 12 Months">6 - 12 Months</option>
                                <option value="18" title="12 - 18 Months">12 - 18 Months</option>
                                <option value="24" title="18 - 24 Months">18 - 24 Months</option>
                                <option value="32" title="Greater than 24 Months">Greater than 24 Months</option>
                              </td>
                            </tr>
                          </div>
                        </div>

                        <div id="incomehistory">
                          <tr>
                            <td colspan=2>
                              <h3>Add proof of income</h3>
                              <td>
                              </tr>

                              <tr>
                                <td style="font-size:12px;">Add proof of income or bank statement. Adding this will improve your chances of being approved.</td>
                                <td><input type="file" class="demoInputBox" name="tenantpoi" id="tenantpoi" value="<?php if(isset($_POST['tenantpoi'])) echo $_POST['tenantpoi']; ?>" ></td>
                              </tr>
                            </div>

                            <div id="appRefer">
                              <tr><td colspan=2><h3>Add references</h3></td></tr>
                              <tr>
                                <td>Full Name</td>
                                <td><input type="text" title="Name" class="demoInputBox" name="referName" id="referName" value="<?php if(isset($_POST['referName'])) echo $_POST['referName']; ?>"></td>
                              </tr>
                              <tr>
                                <td>Relationship</td>
                                <td><input type="text" title="Relationship" class="demoInputBox" name="referRelation" id="referRelation" value="<?php if(isset($_POST['referRelation'])) echo $_POST['referRelation']; ?>"></td>
                              </tr>
                              <tr>
                                <td>Contact Number</td>
                                <td><input type="text" title="Number" class="demoInputBox" name="referNum" id="referNum" value="<?php if(isset($_POST['referNum'])) echo $_POST['referNum']; ?>"></td>
                              </tr>
                              <tr>
                                <td>Contact Email</td>
                                <td><input type="text" title="Email" class="demoInputBox" name="referEmail" id="referEmail" value="<?php if(isset($_POST['referEmail'])) echo $_POST['referEmail']; ?>"></td>
                              </tr>

                              <tr><td><input type="button" value="+ Add another reference" onclick="showRefs2();this.style.display = 'none';"/></td></tr>
                            </div>

                            <div id="appRefer2">
                              <tr class="hiddenRef2">
                                <td>Full Name</td>
                                <td><input type="text" title="Name" class="demoInputBox" name="referName2" id="referName2" value="<?php if(isset($_POST['referName2'])) echo $_POST['referName2']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef2">
                                <td>Relationship</td>
                                <td><input type="text" title="Relationship" class="demoInputBox" name="referRelation2" id="referRelation2" value="<?php if(isset($_POST['referRelation2'])) echo $_POST['referRelation2']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef2">
                                <td>Contact Number</td>
                                <td><input type="text" title="Number" class="demoInputBox" name="referNum2" id="referNum2" value="<?php if(isset($_POST['referNum2'])) echo $_POST['referNum2']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef2">
                                <td>Contact Email</td>
                                <td><input type="text" title="Email" class="demoInputBox" name="referEmail2" id="referEmail2" value="<?php if(isset($_POST['referEmail2'])) echo $_POST['referEmail2']; ?>"></td>
                              </tr>

                              <tr  class="hiddenRef2"><td><input type="button" value="+ Add another reference" onclick="showRefs3();this.style.display = 'none';"/></td></tr>
                            </div>

                            <div id="appRefer3">
                              <tr class="hiddenRef3">
                                <td>Full Name</td>
                                <td><input type="text" title="Name" class="demoInputBox" name="referName3" id="referName3" value="<?php if(isset($_POST['referName3'])) echo $_POST['referName3']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef3">
                                <td>Relationship</td>
                                <td><input type="text" title="Relationship" class="demoInputBox" name="referRelation3" id="referRelation3" value="<?php if(isset($_POST['referRelation3'])) echo $_POST['referRelation3']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef3">
                                <td>Contact Number</td>
                                <td><input type="text" title="Number" class="demoInputBox" name="referNum3" id="referNum3" value="<?php if(isset($_POST['referNum3'])) echo $_POST['referNum3']; ?>"></td>
                              </tr>
                              <tr class="hiddenRef3">
                                <td>Contact Email</td>
                                <td><input type="text" title="Email" class="demoInputBox" name="referEmail3" id="referEmail3" value="<?php if(isset($_POST['referEmail3'])) echo $_POST['referEmail3']; ?>"></td>
                              </tr>
                            </div>

                            <tr>
                              <td>
                                <input type="submit" href="" name="" value="Submit" class="btnSubmit">
                              </td>
                            </tr>

                          </div>
                        </table>
                      </form>
                    </div>
                  </div>


                  <style>

                  #rentaladdbtn{
                    font-size: 16px;
                  }

                  .demo-table {
                    margin-left: 25vw;
                    border-spacing: initial;
                    margin-top: 5vh;
                    word-break:keep-all;
                    table-layout: auto;
                    line-height: 1.8em;
                    color: #333;
                    border-radius: 4px;
                    background-color: white;
                    padding-bottom: 2vh;
                    padding-left: 1vw;
                    padding-right: 1vw;
                    margin-bottom: 5vh;
                  }

                  .demo-table td {
                    padding: 5px 0px 5px 5px;
                  }

                  .demoInputBox {
                    padding: 10px 30px;
                    padding-bottom: 8px;
                    border: #a9a9a9 1px solid;
                    border-radius: 4px;
                  }

                  #rentalhistory{
                    margin-top: 20px;
                    margin-left: 10%;
                    width: 80%;
                  }

                  .btnSubmit {
                    margin-top: 10px;
                    margin-left: 10px;
                    padding: 10px 30px;
                    background-color: #3367b2;
                    border: 0;
                    color: #FFF;
                    cursor: pointer;
                    border-radius: 4px;
                  }

                  .overlay {
                    height: 100%;
                    width: 0;
                    position: fixed;
                    z-index: 3;
                    top: 0;
                    left: 0;
                    background-color: white;
                    background-color: rgba(230,230,230, 0.95);
                    overflow-x: hidden;
                    transition: 0.5s;
                    border-radius: 5px;
                    border: none;
                  }

                  .overlay-content {
                    position: relative;
                    top: 25%;
                    width: 100%;
                    text-align: center;
                    margin-top: 30px;
                  }

                  .overlay a {
                    padding: 8px;
                    text-decoration: none;
                    font-size: 36px;
                    color: #818181;
                    display: block;
                    transition: 0.3s;
                  }

                  .overlay a:hover, .overlay a:focus {
                    color: #f1f1f1;
                  }

                  .overlay .closebtn {
                    position: absolute;
                    top: 20px;
                    right: 45px;
                    font-size: 60px;
                  }

                  @media screen and (max-height: 450px) {
                    .overlay a {font-size: 20px}
                    .overlay .closebtn {
                      font-size: 40px;
                      top: 15px;
                      right: 35px;
                    }
                  }

                  /* The Modal (background) */
                  .modal {
                    display: none; /* hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 3; /* Sit on top */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                  }

                  /* Modal Content/Box */
                  .modal-content {
                    background-color: #fefefe;
                    margin: 15% auto; /* 15% from the top and centered */
                    padding: 20px;
                    border: 1px solid #888;
                    border-radius: 5px;
                    width: 30%; /* Could be more or less, depending on screen size */
                  }

                  /* The Close Button */
                  .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                  }

                  .close:hover,
                  .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                  }

                  </style>
