<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];

$id= $_POST['field_1_add'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("DELETE FROM payment_options WHERE id = :id");

	$STH->execute(array(
	':id' => $id
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "Payment option deleted";

?>