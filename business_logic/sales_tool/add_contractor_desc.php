<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$employee_id= $_POST['field_1_add'];
$desc= $_POST['field_2_add'];
$package_type= $_POST['field_3_add'];
$name= $_POST['field_4_add'];
$trade_name= $_POST['field_5_add'];
$proposal_amount= $_POST['field_6_add'];


try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH2 = $DBH2->prepare("UPDATE subcontractors SET name = :name, trade_name = :trade_name, rate = :rate, description = :description WHERE id = :id");

	$STH2->bindParam(':name', $name);
	$STH2->bindParam(':trade_name', $trade_name);
	$STH2->bindParam(':rate', $proposal_amount);
	$STH2->bindParam(':description', $desc);
	$STH2->bindParam(':id', $employee_id);
	$STH2->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


?>