<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$employee_id= $_POST['field_1_add'];
$hours= $_POST['field_2_add'];
$package_type= $_POST['field_3_add'];



try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH2 = $DBH2->prepare("UPDATE proposal_contractor_hours SET hours = :hours WHERE employee_id = :employee_id AND proposal_id = :proposal_id AND package_type = :package_type");

	$STH2->bindParam(':employee_id', $employee_id);
	$STH2->bindParam(':proposal_id', $proposal_id);
	$STH2->bindParam(':hours', $hours);
	$STH2->bindParam(':package_type', $package_type);
	$STH2->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

?>