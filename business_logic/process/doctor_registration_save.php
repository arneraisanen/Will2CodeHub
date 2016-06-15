<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$title = $_POST['title'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$specialisation = $_POST['specialisation'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$state = $_POST['state'];


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO doctor_details ( title, firstname, surname, email, phone, password, specialisation, address1, address2, address3, state ) values ( :title, :firstname, :surname, :email, :phone, :password, :specialisation , :address1, :address2, :address3, :state)");

	$STH->bindParam(':title', $title);
	$STH->bindParam(':firstname', $firstname);
	$STH->bindParam(':surname', $surname);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':phone', $phone);
	$STH->bindParam(':password', $password);
	$STH->bindParam(':specialisation', $specialisation);
	$STH->bindParam(':address1', $address1);
	$STH->bindParam(':address2', $address2);
	$STH->bindParam(':address3', $address3);
	$STH->bindParam(':state', $state);
	$STH->execute();
	
	$id = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

require_once $doc_root.'/business_logic/admin/db/db_manager_todo.php';
try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO tz_todo ( position, text, dt_added ) values ( :position, :text, :dt_added)");

	$position = 1;
	$todo_text = 'Healthcare Provider <italic>' . $firstname . ' ' . $surname . '</italic> has been added to the database and needs to be approved. <a target="_blank" href="' . $website_root . '/business_logic/admin/show_healthcare_professional_profile.php?action=0&id=' . $id . '">Click here to do so</a>';
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
$Subject = 'Medlist Nigeria: Registration Received';
$Message = "Dear " . $firstname . " " . $surname . ",\r\nThank you for registering with Medlist Nigeria.\r\n\r\nWe are currently in the process of authenticating your registration and will publish it online as soon as we are finished.\r\n\r\nThank you for your interest in Medlist Nigera.\r\n\r\nYours sincerely,\r\nMedlist Nigeria Team";
$Headers = "From: admin@freeimagedesigns.com \r\n" .
		"Reply-To: admin@freeimagedesigns.com \r\n" .
		"Content-type: text/html; charset=UTF-8 \r\n";

mail($To, $Subject, $Message, $Headers);

$To = 'admin@freeimagedesigns.com';
$Subject = 'Medlist Nigeria: Registration Received Notifcation - Automated Email';
$Message = "Dear Dr. Nonso Ejiofor\r\nA new healthcare professional has registered on freeimagedesigns.com\r\n\r\nPlease sign into the following address to publish their profile: http://www.freeimagedesigns.com/business_logic/sign_in.php\r\n\r\nThank you.\r\n\r\nYours sincerely,\r\nMedlist Nigeria Team";
$Headers = "From: admin@freeimagedesigns.com \r\n" .
		"Reply-To: admin@freeimagedesigns.com \r\n" .
		"Content-type: text/html; charset=UTF-8 \r\n";

mail($To, $Subject, $Message, $Headers);

echo "Your profile was successfully submitted - you will receive an email confirming this and informing you of the next steps.";

?>