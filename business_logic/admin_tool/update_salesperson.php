<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$name= $_POST['field_1_add'];
$phone= $_POST['field_2_add'];
$email= $_POST['field_3_add'];
$password_val= $_POST['field_4_add'];
$id= $_POST['field_5_add'];
$commission= $_POST['field_7_add'];
$proposal_init_number= $_POST['field_8_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("UPDATE salesperson SET name = :name, phone = :phone, email = :email, commission = :commission, password = :password_val, proposal_init_number = :proposal_init_number WHERE id=:id");

	$STH->bindParam(':name', $name);
	$STH->bindParam(':phone', $phone);
	$STH->bindParam(':email', $email);
	$STH->bindParam(':commission', $commission);
	$STH->bindParam(':password_val', $password_val);
	$STH->bindParam(':proposal_init_number', $proposal_init_number);
	$STH->bindParam(':id', $id);
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


echo "The entry was successfully added to the database";

?>