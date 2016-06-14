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
$best_markup= $_POST['field_4_add'];
$better_markup= $_POST['field_5_add'];
$good_markup= $_POST['field_6_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM guarantees WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


if ($STH->rowCount() > 0)
{
try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE guarantees SET best = :best, better = :better, good = :good, best_markup = :best_markup, better_markup = :better_markup, good_markup = :good_markup WHERE company_id = :company_id");
	
	$STH->execute(array(
	':best' => $best,
	':better' => $better,
	':good' => $good,
	':best_markup' => $best_markup,
	':better_markup' => $better_markup,
	':good_markup' => $good_markup,
	':company_id' => $company_id
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}
}
else
{
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$STH = $DBH->prepare("INSERT INTO guarantees ( best, better, good, best_markup, better_markup, good_markup, company_id ) values ( :best, :better, :good, :best_markup, :better_markup, :good_markup, :company_id )");

		$STH->execute(array(
		':best' => $best,
		':better' => $better,
		':good' => $good,
		':best_markup' => $best_markup,
		':better_markup' => $better_markup,
		':good_markup' => $good_markup,
		':company_id' => $company_id
		));
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}


echo "Guarantee details updated";

?>