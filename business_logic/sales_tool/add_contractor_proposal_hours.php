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
$package_id= $_POST['package_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM proposal_employee_hours WHERE employee_id='$employee_id' AND proposal_id='$proposal_id' AND package_type='$package_id'");
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
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("UPDATE proposal_employee_hours SET hours = :hours WHERE employee_id = :employee_id AND proposal_id = :proposal_id AND package_type= :package_id");
	
		$STH2->bindParam(':employee_id', $employee_id);
		$STH2->bindParam(':proposal_id', $proposal_id);
		$STH2->bindParam(':package_id', $package_id);
		$STH2->bindParam(':hours', $hours);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else 
{
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH->prepare("INSERT INTO proposal_employee_hours ( employee_id, proposal_id, hours, package_type ) values ( :employee_id, :proposal_id, :hours, :package_id )");
	
		$STH2->bindParam(':employee_id', $employee_id);
		$STH2->bindParam(':proposal_id', $proposal_id);
		$STH2->bindParam(':package_id', $package_id);
		$STH2->bindParam(':hours', $hours);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

?>