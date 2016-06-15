<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id = $_POST['id'];
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
$pin = $_POST['pin'];
$published_user = $_POST['published_user'];
$authenticated_user = $_POST['authenticated_user'];


try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE schools SET contact_first_name = :firstname, contact_surname = :surname, school_name = :school_name, email = :email, mobile = :mobile, password = :password, district = :district,	address1 = :address1, address2 = :address2, address3 = :address3, pin = :pin, online = :online, verified = :verified WHERE id = :id");

	$STH->bindParam(':id', $id);
	$STH->bindParam(':firstname', $firstname);
	$STH->bindParam(':surname', $surname);
	$STH->bindParam(':school_name', $school_name);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':mobile', $mobile);
	$STH->bindParam(':password', $password);
	$STH->bindParam(':district', $state);
	$STH->bindParam(':address1', $address1);
	$STH->bindParam(':address2', $address2);
	$STH->bindParam(':address3', $address3);
	$STH->bindParam(':pin', $pin);
	$STH->bindParam(':online', $published_user);
	$STH->bindParam(':verified', $authenticated_user);
	$STH->execute();
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.  " . $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


echo "The profile of " . $firstname . " " . $surname . " was successfully updated";

?>