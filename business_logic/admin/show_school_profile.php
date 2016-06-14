<?php
session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];

include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

require_once '../admin/db/db_manager.php';

$user_action = $_GET["action"];
$listing_id = $_GET["id"];

ob_start();
include($doc_root.'/business_logic/user_admin/get_states.php');
$states_list = ob_get_contents();
ob_end_clean();


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, contact_first_name, contact_surname, school_name, email, mobile, password, district, address1, address2, address3, pin, verified, online FROM schools WHERE id='$listing_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$count=0;
$total_entries = $STH->rowCount();
while($row = $STH->fetch())
{
	$id = $row["id"];
	$firstname = $row['contact_first_name'];
	$surname = $row['contact_surname'];
	$school_name = $row['school_name'];
	$email = $row['email'];
	$mobile = $row['mobile'];
	$password = $row['password'];
	$state = $row['district'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$pincode = $row['pin'];
	$verified = $row["verified"];
	$online = $row["online"];

	if ($verified)
		$verified_checkbox = "CHECKED";
	else 
		$verified_checkbox = "";
	if ($online)
		$online_checkbox = "CHECKED";
	else 
		$online_checkbox = "";
}

	
if ($user_action == 0)
{
$profile_edit = <<<EOD
		<form id="teacherRegForm" action="#" method="post" enctype="multipart/form-data">
		<input type="file" style="visibility: hidden;" name="file">
	<div class="registration-teach">
		<h2>Edit profile for school (ID: $listing_id)</h2>
		<div class="registration-form">
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						<div class="email-form">
							<label>Contact First Name</label>
							<div class="req">
								<input id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value="$firstname"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="email-form">
							<label>Contact Last Name</label>
							<div class="req">
								<input id="lastName" name="lastName" class="school-name" required="required" type="text" value="$surname"/>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>School Name</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="school_name" name="school_name" class="school-name" required="required" type="text" value="$school_name"/>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Email</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="email" name="email" class="school-name" required="required" type="email" value="$email"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Mobile </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value="$mobile"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Password </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="password" name="password" class="school-name" pattern="^(?=.*[A-Z])(?=.*[!@#$&amp;*])(?=.*[0-9])(?=.*[a-z]).{8}$" required="required" type="password" value="$password"/>
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
							<input id="password_check" type="password" class="school-name" required="required" value="$password"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>District</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
										<select id="district" name="district" class="form-control" title="district">
											<option  value="$state">$state</option> 
											$states_list
										</select>
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
							<input id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value="$address1"/>
							<input id="addressLine2" name="addressLine2" class="school-name" type="text" value="$address2"/>
							<input id="addressLine3" name="addressLine3" class="school-name" type="text" value="$address3"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="pin-cd">
							<label>Pincode</label>
						</div>
						<input id="pincode" name="pincode" class="school-name" type="text" value="$pincode"/>
					</div>
				</div>							
				<div class="row">
					<div class="col-sm-4">
						<label>Authenticated</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="checkbox">
							    <label>
							      <input $verified_checkbox id="authenticated_user" name="authenticated_user" type="checkbox">
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
						<div class="req">
							<div class="checkbox">
							    <label>
							      <input $online_checkbox id="published_user" name="published_user" type="checkbox">
							    </label>
							</div>
						</div>
					</div>
				</div>													
													
				<div class="cancel-submit">
					<ul>
						<li><a href="/business_logic/admin/school_database.php">Cancel</a></li>
						<li>
							<button id="registerBtn" type="button"  onclick="school_registration_update($listing_id);">Update</button>
						</li>
					</ul>
				</div>
							<input type="submit" id="submitBtn" style="visibility: hidden;" />
			</form>
		</div>
	</div>
	</form>
EOD;
}
else
{
$profile_edit = <<<EOD
		<form id="teacherRegForm" action="#" method="post" enctype="multipart/form-data">
		<input type="file" style="visibility: hidden;" name="file">
	<div class="registration-teach">
		<h2>Delete profile for school (ID: $listing_id)</h2>
		<div class="registration-form">
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						<div class="email-form">
							<label>Contact First Name</label>
							<div class="req">
								<input id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value="$firstname"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="email-form">
							<label>Contact Last Name</label>
							<div class="req">
								<input id="lastName" name="lastName" class="school-name" required="required" type="text" value="$surname"/>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>School Name</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="school_name" name="school_name" class="school-name" required="required" type="text" value="$school_name"/>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Email</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="email" name="email" class="school-name" required="required" type="email" value="$email"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Mobile </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value="$mobile"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Password </label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<input id="password" name="password" class="school-name" pattern="^(?=.*[A-Z])(?=.*[!@#$&amp;*])(?=.*[0-9])(?=.*[a-z]).{8}$" required="required" type="password" value="$password"/>
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
							<input id="password_check" type="password" class="school-name" required="required" value="$password"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>District</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="form-group location-select">
										<select id="district" name="district" class="form-control" title="district">
											<option  value="$state">$state</option> 
											$states_list
										</select>
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
							<input id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value="$address1"/>
							<input id="addressLine2" name="addressLine2" class="school-name" type="text" value="$address2"/>
							<input id="addressLine3" name="addressLine3" class="school-name" type="text" value="$address3"/>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="pin-cd">
							<label>Pincode</label>
						</div>
						<input id="pincode" name="pincode" class="school-name" type="text" value="$pincode"/>
					</div>
				</div>							
				<div class="row">
					<div class="col-sm-4">
						<label>Authenticated</label>
					</div>
					<div class="col-sm-4">
						<div class="req">
							<div class="checkbox">
							    <label>
							      <input $verified_checkbox id="authenticated_user" name="authenticated_user" type="checkbox">
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
						<div class="req">
							<div class="checkbox">
							    <label>
							      <input $online_checkbox id="published_user" name="published_user" type="checkbox">
							    </label>
							</div>
						</div>
					</div>
				</div>													
													
				<div class="cancel-submit">
					<ul>
						<li><a href="/business_logic/admin/school_database.php">Cancel</a></li>
						<li>
							<button id="registerBtn" type="button"  onclick="school_registration_delete($listing_id);">Delete</button>
						</li>
					</ul>
				</div>
							<input type="submit" id="submitBtn" style="visibility: hidden;" />
			</form>
		</div>
	</div>
	</form>
EOD;
}

?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Professional Profile</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <h2 class="sub-header">Edit School Profile</h2>

          <section style="background-color: #F0F0F0;">
			<br /><br />
			
			<?php echo $profile_edit ?>
			<br /><br />
		</section>
        </div>
      </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>
  </body>
</html>
