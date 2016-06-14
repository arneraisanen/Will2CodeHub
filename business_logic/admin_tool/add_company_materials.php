<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$description= $_POST['field_1_add'];
$cost= $_POST['field_2_add'];
$ska= $_POST['field_3_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO materials ( cost, description, company_id, ska ) values ( :cost, :description, :company_id, :ska )");

	$STH->bindParam(':description', $description);
	$STH->bindParam(':cost', $cost);
	$STH->bindParam(':company_id', $company_id);
	$STH->bindParam(':ska', $ska);
	$STH->execute();
	
	$id = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


echo "The entry was successfully added to the database";

?>