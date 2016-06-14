<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id = $_SESSION['company_id'];
$role = 'admin';

$name1= $_POST['field_1_add'];
$name2= $_POST['field_2_add'];
$name3= $_POST['field_3_add'];
$name4= $_POST['field_4_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("INSERT INTO users ( firstname, surname, username, password, company_id, role ) values ( :firstname, :surname, :username, :password, :company_id, :role )");

	$STH->bindParam(':firstname', $name1);
	$STH->bindParam(':surname', $name2);
	$STH->bindParam(':username', $name3);
	$STH->bindParam(':password', $name4);
	$STH->bindParam(':company_id', $id);
	$STH->bindParam(':role', $role);
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