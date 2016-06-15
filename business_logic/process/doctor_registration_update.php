<?php
require_once '../admin/db/db_manager.php';

$id = $_POST['id'];
$title = $_POST['title'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$specialisation = $_POST['specialisation'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$state = $_POST['state'];
$verified_user = $_POST['authenticated_user'];
$online_user = $_POST['published_user'];


try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE doctor_details SET title = :title, firstname = :firstname, surname = :surname, email = :email, phone = :phone, mobile = :mobile, specialisation = :specialisation, address1 = :address1, address2 = :address2, address3 = :address3, state = :state, verified = :verified, online = :online WHERE id = :id");
	
	$STH->execute(array(
	':id' => $id,
	':title' => $title,
	':firstname' => $firstname,
	':surname' => $surname,
	':email' => $email,
	':phone' => $phone,
	':mobile' => $mobile,
	':specialisation' => $specialisation,
	':address1' => $address1,
	':address2' => $address2,
	':address3' => $address3,
	':state' => $state,
	':verified' => $verified_user,
	':online' => $online_user
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "The profile of " . $title . " " . $firstname . " " . $surname . " was successfully updated";

?>