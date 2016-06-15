<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$field_1_add= $_POST['field_1_add'];
$field_2_add= $_POST['field_2_add'];
$field_3_add= $_POST['field_3_add'];
$field_4_add= $_POST['field_4_add'];
$field_5_add= $_POST['field_5_add'];
$field_6_add= $_POST['field_6_add'];
$field_7_add= $_POST['field_7_add'];
$field_8_add= $_POST['field_8_add'];
$field_9_add= $_POST['field_9_add'];
$field_10_add= $_POST['field_10_add'];
$field_11_add= $_POST['field_11_add'];
$field_12_add= $_POST['field_12_add'];


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM permit WHERE company_id='$company_id' AND proposal_id='$proposal_id'");
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
	
		$STH2 = $DBH2->prepare("UPDATE permit SET pull_permit = :pull_permit, type1 = :type1,  cost1 = :cost1,  type2 = :type2,  cost2 = :cost2,  type3 = :type3,  cost3 = :cost3,  type4 = :type4,  cost4 = :cost4,  sales_tax = :sales_tax,  tax_exemption_number = :tax_exemption_number,  special_instructions = :special_instructions WHERE company_id = :company_id AND proposal_id = :proposal_id");
	
		$STH2->bindParam(':company_id', $company_id);
		$STH2->bindParam(':proposal_id', $proposal_id);
		$STH2->bindParam(':pull_permit', $field_1_add);
		$STH2->bindParam(':type1', $field_2_add);
		$STH2->bindParam(':cost1', $field_3_add);
		$STH2->bindParam(':type2', $field_4_add);
		$STH2->bindParam(':cost2', $field_5_add);
		$STH2->bindParam(':type3', $field_6_add);
		$STH2->bindParam(':cost3', $field_7_add);
		$STH2->bindParam(':type4', $field_8_add);
		$STH2->bindParam(':cost4', $field_9_add);
		$STH2->bindParam(':sales_tax', $field_10_add);
		$STH2->bindParam(':tax_exemption_number', $field_11_add);
		$STH2->bindParam(':special_instructions', $field_12_add);
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
	
		$STH2 = $DBH2->prepare("INSERT INTO permit ( company_id, proposal_id, pull_permit, type1, cost1, type2, cost2, type3, cost3, type4, cost4, sales_tax, tax_exemption_number, special_instructions) values ( :company_id, :proposal_id, :pull_permit, :type1, :cost1, :type2, :cost2, :type3, :cost3, :type4, :cost4, :sales_tax, :tax_exemption_number, :special_instructions)");
	
		$STH2->bindParam(':company_id', $company_id);
		$STH2->bindParam(':proposal_id', $proposal_id);
		$STH2->bindParam(':pull_permit', $field_1_add);
		$STH2->bindParam(':type1', $field_2_add);
		$STH2->bindParam(':cost1', $field_3_add);
		$STH2->bindParam(':type2', $field_4_add);
		$STH2->bindParam(':cost2', $field_5_add);
		$STH2->bindParam(':type3', $field_6_add);
		$STH2->bindParam(':cost3', $field_7_add);
		$STH2->bindParam(':type4', $field_8_add);
		$STH2->bindParam(':cost4', $field_9_add);
		$STH2->bindParam(':sales_tax', $field_10_add);
		$STH2->bindParam(':tax_exemption_number', $field_11_add);
		$STH2->bindParam(':special_instructions', $field_12_add);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

echo 'Permit entries updated';

?>