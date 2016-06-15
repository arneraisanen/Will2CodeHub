<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id = $_POST['id'];
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
$published_user = $_POST['published_user'];
$authenticated_user = $_POST['authenticated_user'];

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
	
	$STH = $DBH->prepare("UPDATE user_details SET firstname = :firstname, surname = :surname, gender = :gender, dob = :dob,	email = :email,	mobile = :mobile, password = :password, subject = :subject,	fresher = :fresher,	salary = :salary, experience = :experience, state = :state,	preferred_state = :preferred_state,	address1 = :address1, address2 = :address2, address3 = :address3, pincode = :pincode, online = :online, verified = :verified WHERE id = :id");

	$STH->bindParam(':id', $id);
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

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("UPDATE education SET ed_1_ed_c = :ed_1_ed_c, ed_1_ed_p = :ed_1_ed_p, ed_1_ed_y = :ed_1_ed_y, ed_2_ed_c = :ed_2_ed_c, ed_2_ed_p = :ed_2_ed_p, ed_2_ed_y = :ed_2_ed_y, ed_3_ed_c = :ed_3_ed_c, ed_3_ed_p = :ed_3_ed_p, ed_3_ed_y = :ed_3_ed_y, ed_4_ed_c = :ed_4_ed_c, ed_4_ed_p = :ed_4_ed_p, ed_4_ed_y = :ed_4_ed_y WHERE user_id = :user_id");

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

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$STH = $DBH->prepare("DELETE FROM preferred_locations WHERE user_id = :user_id");
	$STH->bindParam(':user_id', $id);
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


echo "The profile of " . $firstname . " " . $surname . " was successfully updated";

?>