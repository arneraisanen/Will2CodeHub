<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$sales_id= $_POST['field_1_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("DELETE FROM salesperson WHERE id='$sales_id'");

	$STH->bindParam(':sales_id', $sub_id);
	$STH->execute();
	
	$id = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


echo "The salesperson was successfully deleted from the database";

?>