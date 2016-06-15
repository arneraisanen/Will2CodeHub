<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'business_logic/admin/db/db_manager.php';


$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$subject = $_POST['subject'];
$fresher = $_POST['fresher'];
$salary = $_POST['salary'];
$experience = $_POST['experience'];
$state = $_POST['state'];
$preferred_state = $_POST['preferred_state'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$pincode = $_POST['pincode'];

//e.g: 11/07/2015 to 2015-07-11
$dob = implode("-", array_reverse(explode("/", $dob)));


$ed_1_ed_c = $_POST['e1_ed_c'];
$ed_1_ed_p = $_POST['e1_ed_p'];
$ed_1_ed_y = $_POST['e1_ed_y'];
$ed_2_ed_c = $_POST['e2_ed_c'];
$ed_2_ed_p = $_POST['e2_ed_p'];
$ed_2_ed_y = $_POST['e2_ed_y'];
$ed_3_ed_c = $_POST['e3_ed_c'];
$ed_3_ed_p = $_POST['e3_ed_p'];
$ed_3_ed_y = $_POST['e3_ed_y'];
$ed_4_ed_c = $_POST['e4_ed_c'];
$ed_4_ed_p = $_POST['e4_ed_p'];
$ed_4_ed_y = $_POST['e4_ed_y'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO user_details ( firstname, surname, gender, dob, email, mobile, password, subject, fresher, salary, experience, state, preferred_state, address1, address2, address3, pincode ) values ( :firstname, :surname, :gender, :dob, :email, :mobile, :password, :subject, :fresher, :salary, :experience, :state, :preferred_state, :address1, :address2, :address3, :pincode)");

	$STH->bindParam(':firstname', $firstname);
	$STH->bindParam(':surname', $surname);
	$STH->bindParam(':gender', $gender);
	$STH->bindParam(':dob', $dob);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':mobile', $mobile);
	$STH->bindParam(':password', $password);
	$STH->bindParam(':subject', $subject);
	$STH->bindParam(':fresher', $fresher);
	$STH->bindParam(':salary', $salary);
	$STH->bindParam(':experience', $experience);
	$STH->bindParam(':state', $state);
	$STH->bindParam(':preferred_state', $preferred_state);
	$STH->bindParam(':address1', $address1);
	$STH->bindParam(':address2', $address2);
	$STH->bindParam(':address3', $address3);
	$STH->bindParam(':pincode', $pincode);
	$STH->execute();
	
	$id = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO education (user_id, ed_1_ed_c, ed_1_ed_p, ed_1_ed_y, ed_2_ed_c, ed_2_ed_p, ed_2_ed_y, ed_3_ed_c, ed_3_ed_p, ed_3_ed_y, ed_4_ed_c, ed_4_ed_p, ed_4_ed_y ) values ( :user_id, :ed_1_ed_c, :ed_1_ed_p, :ed_1_ed_y, :ed_2_ed_c, :ed_2_ed_p, :ed_2_ed_y, :ed_3_ed_c, :ed_3_ed_p, :ed_3_ed_y, :ed_4_ed_c, :ed_4_ed_p, :ed_4_ed_y)");

	$STH->bindParam(':user_id', $id);
	$STH->bindParam(':ed_1_ed_c', $ed_1_ed_c);
	$STH->bindParam(':ed_1_ed_p', $ed_1_ed_p);
	$STH->bindParam(':ed_1_ed_y', $ed_1_ed_y);
	$STH->bindParam(':ed_2_ed_c', $ed_2_ed_c);
	$STH->bindParam(':ed_2_ed_p', $ed_2_ed_p);
	$STH->bindParam(':ed_2_ed_y', $ed_2_ed_y);
	$STH->bindParam(':ed_3_ed_c', $ed_3_ed_c);
	$STH->bindParam(':ed_3_ed_p', $ed_3_ed_p);
	$STH->bindParam(':ed_3_ed_y', $ed_3_ed_y);
	$STH->bindParam(':ed_4_ed_c', $ed_4_ed_c);
	$STH->bindParam(':ed_4_ed_p', $ed_4_ed_p);
	$STH->bindParam(':ed_4_ed_y', $ed_4_ed_y);
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$preferred_state = explode(",",$preferred_state);
foreach($preferred_state as $location)
{
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("INSERT INTO preferred_locations ( user_id, location ) values ( :user_id, :location)");
	
		$STH->bindParam(':user_id', $id);
		$STH->bindParam(':location', $location);
		$STH->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}	
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO tz_todo ( position, text, dt_added ) values ( :position, :text, :dt_added)");

	$position = 1;
	$todo_text = 'Teacher <italic>' . $firstname . ' ' . $surname . '</italic> has been added to the database and needs to be approved. <a target="_blank" href="' . $website_root . '/business_logic/admin/show_healthcare_professional_profile.php?action=0&id=' . $id . '">Click here to do so</a>';
	$date_added = date("Y-m-d H:i:s");
	$STH->bindParam(':position', $position);
	$STH->bindParam(':text', $todo_text);
	$STH->bindParam(':dt_added', $date_added);
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$To = $email;
$Subject = 'Your Teachers: Registration Received';
$Message = "Dear " . $firstname . " " . $surname . ",\r\nThank you for registering with Your teachers.\r\n\r\nWe are currently in the process of authenticating your registration and will publish it online as soon as we are finished.\r\n\r\nThank you for your interest in Your Teachers.\r\n\r\nYours sincerely,\r\nYour Teachers Team";
$Headers = "From: admin@yourteachers.in \r\n" .
		"Reply-To: admin@yourteachers.in \r\n" .
		"Content-type: text/html; charset=UTF-8 \r\n";

mail($To, $Subject, $Message, $Headers);

$To = 'admin@yourteachers.in';
$Subject = 'Your Teachers: Registration Received Notifcation - Automated Email';
$Message = "Dear XXX\r\nA new teacher has registered on yourteachers.com\r\n\r\nPlease sign into the following address to publish their profile: http://www.yourteachers.com/business_logic/sign_in.php\r\n\r\nThank you.\r\n\r\nYours sincerely,\r\nYour Teachers Team";
$Headers = "From: admin@yourteachers.in \r\n" .
		"Reply-To: admin@yourteachers.in \r\n" .
		"Content-type: text/html; charset=UTF-8 \r\n";

mail($To, $Subject, $Message, $Headers);

echo "Your profile was successfully submitted - you will receive an email confirming this and informing you of the next steps.  Thank you for your interest in Your Teachers.";

?>