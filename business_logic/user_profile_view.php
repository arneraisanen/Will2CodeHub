<?php
session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "teacher" && $_SESSION['role'] != "admin" )
	{
		header('Location: http://www.yourteachers.in/business_logic/sign_in.php');
		exit; 
	}
}
else
{
	header('Location: http://www.yourteachers.in/business_logic/sign_in.php');
	exit;
}

require_once 'admin/db/db_manager.php';

$listing_id = $_SESSION['id'];

ob_start();
include($doc_root.'/business_logic/user_admin/get_subjects.php');
$subjects_list = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root.'/business_logic/user_admin/get_states.php');
$states_list = ob_get_contents();
ob_end_clean();

$multiselect_location = 1;
ob_start();
include($doc_root.'/business_logic/user_admin/get_states.php');
$multi_states_list = ob_get_contents();
ob_end_clean();

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, firstname, surname, gender, dob, email, mobile, password, subject, fresher, salary, experience, state, preferred_state, education, address1, address2, address3, pincode, verified, online FROM user_details WHERE id='$listing_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$count=0;
$total_entries = $STH->rowCount();
while($row = $STH->fetch())
{
	$id = $row["id"];
	$firstname = $row['firstname'];
	$surname = $row['surname'];
	$gender = $row['gender'];
	$dob = $row['dob'];
	$email = $row['email'];
	$mobile = $row['mobile'];
	$password = $row['password'];
	$subject = $row['subject'];
	$fresher = $row['fresher'];
	$salary = $row['salary'];
	$experience = $row['experience'];
	$state = $row['state'];
	$preferred_state = $row['preferred_state'];
	$education = $row['education'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$pincode = $row['pincode'];
	$verified = $row["verified"];
	$online = $row["online"];
	
	switch ($salary)
	{
		case 10000:
			$salary="10000 - 20000";
			break;
	
		case 20000:
			$salary="20000 - 30000";
			break;
	
		case 30000:
			$salary="30000 - 40000";
			break;
	
		case 40000:
			$salary="40000 - 50000";
			break;
	}
	
	switch ($experience)
	{
		case 0:
			$experience="0 - 1";
		break;
		
		case 1:
			$experience="1 - 2";
			break;
		
		case 2:
			$experience="2 - 3";
			break;
		
		case 3:
			$experience="3 - 4";
			break;
		
		case 4:
			$experience="4 - 5";
			break;
		
		case 5:
			$experience="5 - 6";
			break;
		
		case 6:
			$experience="6 - 7";
			break;
		
		case 7:
			$experience="7 - 8";
			break;
		
		case 8:
			$experience="8 - 9";
			break;
		
		case 9:
			$experience="9 - 10";
			break;
	}
	
	$dob = implode("/", array_reverse(explode("-", $dob)));
	
	if ($verified)
		$verified_checkbox = "CHECKED";
	if ($online)
		$online_checkbox = "CHECKED";
	if ($fresher)
		$fresher_checkbox = "active";
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT user_id, ed_1_ed_c, ed_1_ed_p, ed_1_ed_y, ed_2_ed_c, ed_2_ed_p, ed_2_ed_y, ed_3_ed_c, ed_3_ed_p, ed_3_ed_y, ed_4_ed_c, ed_4_ed_p, ed_4_ed_y FROM education WHERE user_id='$listing_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$ed_1_ed_c = $row['ed_1_ed_c'];
	$ed_1_ed_p = $row['ed_1_ed_p'];
	$ed_1_ed_y = $row['ed_1_ed_y'];
	$ed_2_ed_c = $row['ed_2_ed_c'];
	$ed_2_ed_p = $row['ed_2_ed_p'];
	$ed_2_ed_y = $row['ed_2_ed_y'];
	$ed_3_ed_c = $row['ed_3_ed_c'];
	$ed_3_ed_p = $row['ed_3_ed_p'];
	$ed_3_ed_y = $row['ed_3_ed_y'];
	$ed_4_ed_c = $row['ed_4_ed_c'];
	$ed_4_ed_p = $row['ed_4_ed_p'];
	$ed_4_ed_y = $row['ed_4_ed_y'];
}
	

$profile_display = <<<EOD
		<form id="teacherRegForm" action="#" method="post" enctype="multipart/form-data">
		<input type="file" style="visibility: hidden;" name="file">
		<div class="registration-teach">
		<div class="registration-form">
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						<div class="email-form">
							<label>First Name</label>
							<div class="req">
								<input readonly value="$firstname" id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="email-form">
							<label>Last Name</label>
							<div class="req">
								<input readonly value="$surname" id="lastName" name="lastName" class="school-name" required="required" type="text" value=""/>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Date-of-birth</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$dob" id="dob" name="dateOfBirth" class="school-name" required="required"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Gender</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
								<select disabled style="background-color: #ffffff;" id="gender" name="gender" class="form-control" title="Location">
									<option value="$gender">$gender</option>
									<option value="Male"> Male</option>
									<option value="Female">Female </option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Email</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Mobile </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Password </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$password" id="password" name="password" class="school-name" pattern="^(?=.*[A-Z])(?=.*[!@#$&amp;*])(?=.*[0-9])(?=.*[a-z]).{8}$" required="required" type="password" value=""/>
						</div>
					</div>
					<div class="col-sm-4">
						<p class="password-txt">Minimum 8 characters, including
							1 Upper Case, 1 Lower Case, 1 special character  and 1 number.
							</h2>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Re-type Password</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$password" id="password_check" type="password" class="school-name" required="required"/>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Subject</label>
					</div>
					<div class="col-sm-4">
								<div class="req">
									<div class="form-group location-select">
										<select id="subject" name="subject" class="form-control" title="subjects" required="required">
											<option disabled style="background-color: #ffffff;" value="$subject">$subject</option>
											$subjects_list
										</select>
									</div>
								</div>
							</div>
					<div class="col-sm-4">
						<div class="btn-group" data-toggle="buttons">
							<label class="btn check-b-a fresh-check $fresher_checkbox"> Fresher
								<input readonly id="fresher" type="checkbox" autocomplete="off" >
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Expected salary</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
								<select disabled style="background-color: #ffffff;" id="expectedSalary" name="expectedSalary" class="form-control" title="salary">
									<option  value="$salary">$salary</option>
									<option value="20000"> 10000 - 20000</option>
									<option value="30000">20000 - 30000 </option>
									<option value="40000"> 30000 - 40000</option>
									<option value="50000"> 40000 - 50000</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Experience</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
								<select disabled style="background-color: #ffffff;" id="experience" name="experience" class="form-control" title="experience">
									<option value="$experience">$experience</option>
									<option value="0"> 0 - 1</option>
									<option value="1">1 - 2 </option>
									<option value="2">2 - 3</option>
									<option value="3">3 - 4</option>
									<option value="4">4 - 5 </option>
									<option value="5">5 - 6 </option>
									<option value="6">6 - 7</option>
									<option value="7">7 - 8</option>
									<option value="8">8 - 9</option>
									<option value="9">9 - 10</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>District Name</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
										<select disabled style="background-color: #ffffff;" id="district" name="district" class="form-control" title="district">
												<option  value="$state">$state</option>
												$states_list
										</select>
									</div>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-sm-4">
						<label>Preferred Locations</label>
					</div>
							<div class="col-sm-4">
								<div class="">
									<div class="primary-sm">
										<div class="form-group location-select">
											<select disabled style="background-color: #ffffff;" id="preferredLocations" name="preferredLocations" title="Location" class="form-control" multiple="multiple">
												$multi_states_list
											</select><input type="hidden" name="_preferredLocations" value="1"/>
										</div>
									</div>
								</div>
							</div>
						</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Education </label>
					</div>
					<div class="col-sm-8">
						<div class="education-tbl-main">
							<div class="education-tbl">
								<table class="table table-bordered">
									<tr class="title">
										<th width="15%">Degree</th>
										<th>College</th>
										<th width="15%">Percentage</th>
										<th width="15%">Year</th>
									</tr>
									<tr>
										<td>UG</td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_1_ed_c" id="ugDegCollName" name="ugDegCollName" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_1_ed_p" id="ugDegPercentage" name="ugDegPercentage" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_1_ed_y" id="ugDegYear" name="ugDegYear" class="form-control tfield" type="text" /></td>
									</tr>
									<tr>
										<td>PG</td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_2_ed_c" id="pgDegCollName" name="pgDegCollName" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_2_ed_p" id="pgDegPercentage" name="pgDegPercentage" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_2_ed_y" id="pgDegYear" name="pgDegYear" class="form-control tfield" type="text" /></td>
									</tr>
									<tr>
										<td>B.Ed</td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_3_ed_c" id="bEdColName" name="bEdColName" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_3_ed_p" id="bEdPercentage" name="bEdPercentage" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_3_ed_y" id="bEdYear" name="bEdYear" class="form-control tfield" type="text" /></td>
									</tr>
									<tr>
										<td>M.Ed</td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_4_ed_c" id="mEdColName" name="mEdColName" class="form-control tfield" type="text" /></td>
										<td><input style="background-color: #ffffff;" readonly value="$ed_4_ed_p" id="mEdPercentage" name="mEdPercentage" class="form-control tfield" type="text" /></td>
										<td><input disabled style="background-color: #ffffff;" readonly value="$ed_4_ed_y" id="mEdYear" name="mEdYear" class="form-control tfield" type="text" /></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Address</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input readonly value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
							<input readonly value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
							<input readonly value="$address3" id="addressLine3" name="addressLine3" class="school-name" type="text" value=""/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="pin-cd">
							<label>Pincode</label>
						</div>
						<input readonly value="$pincode" id="pincode" name="pincode" class="school-name" type="text" value=""/>
					</div>
				</div>
												
				<div class="row">
					<div class="col-sm-4">
						<label>Authenticated</label>
					</div>
					<div class="col-sm-4">
						<div class="">
							<div class="checkbox">
							    <label>
							      <input readonly $verified_checkbox id="authenticated_user" name="authenticated_user" type="checkbox">
							    </label>
							</div>
						</div>
					</div>
				</div>
									
				<div class="row">
					<div class="col-sm-4">
						<label>Published</label>
					</div>
					<div class="col-sm-4">
						<div class="">
							<div class="checkbox">
							    <label>
							      <input readonly $online_checkbox id="published_user" name="published_user" type="checkbox">
							    </label>
							</div>
						</div>
					</div>
				</div>
								
				<div class="cancel-submit">
					<ul>
						<li><a href="http://www.yourteachers.in/business_logic/admin/professionals_database.php">Cancel</a></li>
						<li>
							<button id="registerBtn" type="button" onclick="user_registration_delete($listing_id);">Delete</button>
						</li>
					</ul>
				</div>
							<input type="submit" id="submitBtn" style="visibility: hidden;" />
			</form>
		</div>
	</div>
	</form>
EOD;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Healthcare Provider Profile</title>
    <link type="text/css" rel="stylesheet" href="rating/css/style.css">
    <link type="text/css" rel="stylesheet" href="rating/css/example.css">
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>

    <div class="container marketing" style="clear:both;">

    <hr class="featurette-divider" style="margin: 10px 0 0px 0;">

		<div class="row featurette">
        <div class="col-md-12">
        	<h2 class="featurette-heading"><?php echo $title . ' ' . $firstname . ' ' . $surname ?></h3>
          	<p></p><br />
          	<div class="table-responsive">
          		<?php echo $profile_display ?>
			</div>
			<div class="tuto-cnt">
			<div class="box-result-cnt" style="  float: left;">
            <?php
                $query = mysql_query("SELECT * FROM wcd_rate WHERE id_post='$id'"); 
                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
            ?>
            <h3>The content was rated <strong><?php echo $rate_times; ?></strong> times</h3>
            <h3>The rating is at <strong><?php echo $rate_value; ?></strong></h3>
            <hr>
            <div class="rate-result-cnt">
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>
        </div><!-- /rate-result-cnt -->
		        <div class="rate-ex1-cnt">
		            <div id="1" class="rate-btn-1 rate-btn"></div>
		            <div id="2" class="rate-btn-2 rate-btn"></div>
		            <div id="3" class="rate-btn-3 rate-btn"></div>
		            <div id="4" class="rate-btn-4 rate-btn"></div>
		            <div id="5" class="rate-btn-5 rate-btn"></div>
		        </div>
		    </div>
		    
		    <br><br><br><br><br>
        </div>
      </div>

      <hr class="featurette-divider">
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->
    
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>

  <script>
        // rating script
        $(function(){ 
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });
                            
            $('.rate-btn').click(function(){    
                var therate = $(this).attr('id');
                var dataRate = 'act=rate&post_id=<?php echo $listing_id; ?>&rate='+therate; //
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };
                $.ajax({
                    type : "POST",
                    url : "http://www.yourteachers.in/business_logic/rating/ajax.php",
                    data: dataRate,
                    success:function(){}
                });
                
            });
        });
    </script> 
  </body>
</html>
