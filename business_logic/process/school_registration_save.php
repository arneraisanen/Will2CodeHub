<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';


$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$school_name = $_POST['school_name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$state = $_POST['state'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$pincode = $_POST['pincode'];


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO schools ( contact_first_name, contact_surname, school_name, email, mobile, password, district, address1, address2, address3, pin, role ) values ( :contact_first_name, :contact_surname, :school_name, :email, :mobile, :password, :district, :address1, :address2, :address3, :pin, :role)");

	$STH->bindParam(':contact_first_name', $firstname);
	$STH->bindParam(':contact_surname', $surname);
	$STH->bindParam(':school_name', $school_name);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':mobile', $mobile);
	$STH->bindParam(':password', $password);
	$STH->bindParam(':district', $state);
	$STH->bindParam(':address1', $address1);
	$STH->bindParam(':address2', $address2);
	$STH->bindParam(':address3', $address3);
	$STH->bindParam(':pin', $pincode);
	$STH->bindParam(':role', "school");
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

	$STH = $DBH->prepare("INSERT INTO users ( firstname, surname, username, password, role ) values ( :firstname, :surname, :username, :password, :role)");

	$STH->bindParam(':firstname', $firstname);
	$STH->bindParam(':surname', $surname);
	$STH->bindParam(':username', $email);
	$STH->bindParam(':password', $password);
	$STH->bindParam(':role', "school");
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

	$STH = $DBH->prepare("INSERT INTO tz_todo ( position, text, dt_added ) values ( :position, :text, :dt_added)");

	$position = 1;
	$todo_text = 'School <italic>' . $school_name . '</italic> has been added to the database and needs to be approved. <a target="_blank" href="' . $website_root . '/business_logic/admin/show_school_profile.php?action=0&id=' . $id . '">Click here to do so</a>';
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
$Subject = 'Your Teachers: School Registration Received';
$Message = "Dear " . $contact_first_name . " " . $contact_surname . ",\r\nThank you for registering your school with Your teachers.\r\n\r\nWe are currently in the process of authenticating your registration and will publish it online as soon as we are finished.\r\n\r\nThank you for your interest in Your Teachers.\r\n\r\nYours sincerely,\r\nYour Teachers Team";
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