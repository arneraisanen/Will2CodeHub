<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];

$best= $_POST['field_1_add'];
$better= $_POST['field_2_add'];
$good= $_POST['field_3_add'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE guarantees SET best = :best, better = :better, good = :good WHERE company_id = :company_id");
	
	$STH->execute(array(
	':best' => $best,
	':better' => $better,
	':good' => $good,
	':company_id' => $company_id
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "Guarantee details updated";

?>