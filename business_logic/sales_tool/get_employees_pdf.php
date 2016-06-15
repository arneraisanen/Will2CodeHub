<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];
$package_type = $_SESSION['package_type'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, employee_id, hours FROM proposal_employee_hours WHERE proposal_id='$proposal_id' AND package_type='$package_type'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";

	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


$employee_cost = 0;
settype($employee_cost, "float");

$count = 1;
while($row = $STH->fetch())
{
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$employee_id_tmp = $row["employee_id"];
		$STH2 = $DBH2->prepare("SELECT rate FROM employees WHERE id='$employee_id_tmp'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	if ($STH2->rowCount() > 0)
	{
		while($row2 = $STH2->fetch())
		{			
			$employee_cost += $row2["rate"] * $row["hours"];
		}
	}
	
	$count++;
}