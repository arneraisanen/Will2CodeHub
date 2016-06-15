<?php
session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "admin" )
	{
		header('Location: http://www.freeimagedesigns.com/business_logic/sign_in.php');
		exit; 
	}
}
else
{
	header('Location: http://www.freeimagedesigns.com/business_logic/sign_in.php');
	exit;
}

require_once '../admin/db/db_manager.php';

$user_action = $_GET["action"];
$listing_id = $_GET["id"];

ob_start();
include($doc_root.'/business_logic/doctors_admin/get_doctor_specialisations.php');
$doctor_specialisations = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root.'/business_logic/doctors_admin/get_cities.php');
$doctors_city = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root.'/business_logic/doctors_admin/get_states.php');
$doctors_state = ob_get_contents();
ob_end_clean();

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, title, firstname, surname, email, phone, mobile, specialisation, address1, address2, address3, state, verified, online FROM doctor_details WHERE id='$listing_id'");
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
$series_entries = '{ "data": [ ';
if ($total_entries)
{
	while($row = $STH->fetch())
	{
		$id = $row["id"];
		$title = $row["title"];
		$firstname = $row["firstname"];
		$surname = $row["surname"];
		$email = $row["email"];
		$phone = $row["phone"];
		$mobile = $row["mobile"];
		$specialisation = $row["specialisation"];
		$address1 = $row["address1"];
		$address2 = $row["address2"];
		$city = $row["address3"];
		$state = $row["state"];
		$verified = $row["verified"];
		$online = $row["online"];
		
		if ($verified)
			$verified_checkbox = "CHECKED";
		if ($online)
			$online_checkbox = "CHECKED";
		
		if ($user_action == 0)
		{
	$profile_edit = <<<EOD
			<form id="teacherRegForm" action="healthcare_professional_edit_save.php" method="post" enctype="multipart/form-data">
			<input type="file" style="visibility: hidden;" name="file">
			<div class="registration-teach">
			<h2>Healthcare Professional Profile (ID: $id)</h2>
			<div class="registration-form">
			<form id="theform">
			<div class="row">
						<div class="col-sm-6">
							<div class="email-form">
								<label>Title </label>
								<div class="req">
									<input value="$title" id="title" name="title" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
								</div>
							</div>
						</div>
					</div>
					
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>First Name</label>
			<div class="req">
			<input value="$firstname" id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="email-form">
			<label>Last Name</label>
			<div class="req">
			<input value="$surname" id="lastName" name="lastName" class="school-name" required="required" type="text" value=""/>
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
			<input value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
			</div>
			</div>
			</div>
			
			
					<div class="row">
						<div class="col-sm-4">
							<label>Phone </label>
						</div>
						<div class="col-sm-4">
							<div class="req">
								<input id="landlineNumber" name="landlineNumber" class="school-name" required="required" type="number" value="$phone"/>
							</div>
						</div>
					</div>
			
			<div class="row">
			<div class="col-sm-4">
			<label>Mobile </label>
			</div>
			<div class="col-sm-4">
			<div class="">
			<input value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
			</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-sm-4">
			<label>Specialisation </label>
			</div>
			<div class="col-sm-4">
			<div class="req" style="height: 56px;">
			<select id="specialisation" class="form-control">
											 <option value="$specialisation">$specialisation</option>
										     $doctor_specialisations
										</select>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<label>Practice Address</label>
								</div>
								<div class="col-sm-4">
									<div class="req">
										<input value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
										<input value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
										<select id="addressLine3" name="addressLine3" class="form-control">
										    <option value="$city">$city</option>
										    $doctors_city
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pin-cd">
										<label>State </label>
									</div>
									<div class="req">
										<select id="ownership" name="ownership" class="form-control">
										    <option value="$state">$state</option>
								    		$doctors_state
										</select>
									</div>
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
									<li><a href="#"  onclick="cancel_healthcare_professional_edit();">Cancel</a></li>
									<li>
										<button id="registerBtn" type="button" onclick="doctor_registration_update($id);">Update</button>
									</li>
								</ul>
							</div>
										<input type="submit" id="submitBtn" style="visibility: hidden;" />
						</form>
EOD;
		}
		else
		{
	$profile_edit = <<<EOD
			<form id="teacherRegForm" action="healthcare_professional_edit_save.php" method="post" enctype="multipart/form-data">
			<input type="file" style="visibility: hidden;" name="file">
			<div class="registration-teach">
			<h2>Healthcare Professional Profile (ID: $id)</h2>
			<div class="registration-form">
			<form id="theform">
			<div class="row">
						<div class="col-sm-6">
							<div class="email-form">
								<label>Title </label>
								<div class="req">
									<input value="$title" id="title" name="title" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
								</div>
							</div>
						</div>
					</div>
					
			
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>First Name</label>
			<div class="req">
			<input READONLY value="$firstname" id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="email-form">
			<label>Last Name</label>
			<div class="req">
			<input READONLY value="$surname" id="lastName" name="lastName" class="school-name" required="required" type="text" value=""/>
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
			<input READONLY value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
			</div>
			</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<label>Phone </label>
				</div>
				<div class="col-sm-4">
					<div class="req">
						<input id="landlineNumber" name="landlineNumber" class="school-name" required="required" type="number" value="$phone"/>
					</div>
				</div>
			</div>
			
			<div class="row">
			<div class="col-sm-4">
			<label>Mobile </label>
			</div>
			<div class="col-sm-4">
			<div class="">
			<input READONLY value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
			</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-sm-4">
			<label>Specialisation </label>
			</div>
			<div class="col-sm-4">
			<div class="req" style="height: 56px;">
			<select READONLY id="specialisation" class="form-control">
											 <option value="$specialisation">$specialisation</option>
										     $doctor_specialisations
										</select>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<label>Practice Address</label>
								</div>
								<div class="col-sm-4">
									<div class="req">
										<input READONLY value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
										<input READONLY value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
										<select READONLY id="addressLine3" name="addressLine3" class="form-control">
										    <option value="$city">$city</option>
										    $doctors_city
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pin-cd">
										<label>State </label>
									</div>
									<div class="req">
										<select id="ownership" name="ownership" class="form-control">
										    <option value="$state">$state</option>
								    		$doctors_state
										</select>
									</div>
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
										      <input READONLY $verified_checkbox id="authenticated_user" name="authenticated_user" type="checkbox">
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
										      <input READONLY $online_checkbox id="published_user" name="published_user" type="checkbox">
										    </label>
										</div>
									</div>
								</div>
							</div>
												
							<div class="cancel-submit">
								<ul>
									<li><a href="#"  onclick="cancel_healthcare_professional_edit();">Cancel</a></li>
									<li>
										<button id="registerBtn" type="button" onclick="doctor_registration_delete($id);">Delete</button>
									</li>
								</ul>
							</div>
										<input type="submit" id="submitBtn" style="visibility: hidden;" />
						</form>
EOD;
		}
	}
}
else
{
	if ($user_action == 0)
	{
		$profile_edit = <<<EOD
			<form id="teacherRegForm" action="healthcare_professional_edit_save.php" method="post" enctype="multipart/form-data">
			<input type="file" style="visibility: hidden;" name="file">
			<div class="registration-teach">
			<h2>Healthcare Professional Profile (ID: $id)</h2>
			<div class="registration-form">
			<form id="theform">
			<div class="row">
						<div class="col-sm-6">
							<div class="email-form">
								<label>Title </label>
								<div class="req">
									<input value="$title" id="title" name="title" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
								</div>
							</div>
						</div>
					</div>
			
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>First Name</label>
			<div class="req">
			<input value="$firstname" id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="email-form">
			<label>Last Name</label>
			<div class="req">
			<input value="$surname" id="lastName" name="lastName" class="school-name" required="required" type="text" value=""/>
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
			<input value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
			</div>
			</div>
			</div>
		
		
					<div class="row">
						<div class="col-sm-4">
							<label>Phone </label>
						</div>
						<div class="col-sm-4">
							<div class="req">
								<input id="landlineNumber" name="landlineNumber" class="school-name" required="required" type="number" value="$phone"/>
							</div>
						</div>
					</div>
		
			<div class="row">
			<div class="col-sm-4">
			<label>Mobile </label>
			</div>
			<div class="col-sm-4">
			<div class="">
			<input value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
			</div>
			</div>
			</div>
		
			<div class="row">
			<div class="col-sm-4">
			<label>Specialisation </label>
			</div>
			<div class="col-sm-4">
			<div class="req" style="height: 56px;">
			<select id="specialisation" class="form-control">
											 <option value="$specialisation">$specialisation</option>
										     $doctor_specialisations
										</select>
									</div>
								</div>
							</div>
				
				
							<div class="row">
								<div class="col-sm-4">
									<label>Practice Address</label>
								</div>
								<div class="col-sm-4">
									<div class="req">
										<input value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
										<input value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
										<select id="addressLine3" name="addressLine3" class="form-control">
										    <option value="$city">$city</option>
										    $doctors_city
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pin-cd">
										<label>State </label>
									</div>
									<div class="req">
										<select id="ownership" name="ownership" class="form-control">
										    <option value="$state">$state</option>
								    		$doctors_state
										</select>
									</div>
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
									<li><a href="#"  onclick="cancel_healthcare_professional_edit();">Cancel</a></li>
									<li>
										<button id="registerBtn" type="button" onclick="doctor_registration_update($id);">Update</button>
									</li>
								</ul>
							</div>
										<input type="submit" id="submitBtn" style="visibility: hidden;" />
						</form>
EOD;
		}
		else
		{
	$profile_edit = <<<EOD
			<form id="teacherRegForm" action="healthcare_professional_edit_save.php" method="post" enctype="multipart/form-data">
			<input type="file" style="visibility: hidden;" name="file">
			<div class="registration-teach">
			<h2>Healthcare Professional Profile (ID: $id)</h2>
			<div class="registration-form">
			<form id="theform">
			<div class="row">
						<div class="col-sm-6">
							<div class="email-form">
								<label>Title </label>
								<div class="req">
									<input value="$title" id="title" name="title" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
								</div>
							</div>
						</div>
					</div>
			
		
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>First Name</label>
			<div class="req">
			<input READONLY value="$firstname" id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="email-form">
			<label>Last Name</label>
			<div class="req">
			<input READONLY value="$surname" id="lastName" name="lastName" class="school-name" required="required" type="text" value=""/>
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
			<input READONLY value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
			</div>
			</div>
			</div>
		
			<div class="row">
				<div class="col-sm-4">
					<label>Phone </label>
				</div>
				<div class="col-sm-4">
					<div class="req">
						<input id="landlineNumber" name="landlineNumber" class="school-name" required="required" type="number" value="$phone"/>
					</div>
				</div>
			</div>
		
			<div class="row">
			<div class="col-sm-4">
			<label>Mobile </label>
			</div>
			<div class="col-sm-4">
			<div class="">
			<input READONLY value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
			</div>
			</div>
			</div>
		
			<div class="row">
			<div class="col-sm-4">
			<label>Specialisation </label>
			</div>
			<div class="col-sm-4">
			<div class="req" style="height: 56px;">
			<select READONLY id="specialisation" class="form-control">
											 <option value="$specialisation">$specialisation</option>
										     $doctor_specialisations
										</select>
									</div>
								</div>
							</div>
				
				
							<div class="row">
								<div class="col-sm-4">
									<label>Practice Address</label>
								</div>
								<div class="col-sm-4">
									<div class="req">
										<input READONLY value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
										<input READONLY value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
										<select READONLY id="addressLine3" name="addressLine3" class="form-control">
										    <option value="$city">$city</option>
										    $doctors_city
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="pin-cd">
										<label>State </label>
									</div>
									<div class="req">
										<select id="ownership" name="ownership" class="form-control">
										    <option value="$state">$state</option>
								    		$doctors_state
										</select>
									</div>
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
										      <input READONLY $verified_checkbox id="authenticated_user" name="authenticated_user" type="checkbox">
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
										      <input READONLY $online_checkbox id="published_user" name="published_user" type="checkbox">
										    </label>
										</div>
									</div>
								</div>
							</div>
	
							<div class="cancel-submit">
								<ul>
									<li><a href="#"  onclick="cancel_healthcare_professional_edit();">Cancel</a></li>
									<li>
										<button id="registerBtn" type="button" onclick="doctor_registration_delete($id);">Delete</button>
									</li>
								</ul>
							</div>
										<input type="submit" id="submitBtn" style="visibility: hidden;" />
						</form>
EOD;
		}
}
												
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Healthcare professional Profile</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <h2 class="sub-header">Edit Healthcare Professional Profile</h2>

          <section>
			<br /><br />
			
			<?php echo $profile_edit ?>
			<br /><br />
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
