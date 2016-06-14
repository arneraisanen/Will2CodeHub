<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$overhead= $_POST['field_1_add'];
$profit_margin= $_POST['field_2_add'];
$salesperson_commission= $_POST['field_3_add'];
$admin_cost= $_POST['field_4_add'];
$sub_con_markup= $_POST['field_5_add'];
$salesperson_edit_matrix= $_POST['field_6_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM company WHERE company_id='$company_id'");
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
	
		$STH = $DBH->prepare("UPDATE company SET overhead = :overhead, profit_margin = :profit_margin, admin_cost = :admin_cost, salesperson_commission = :salesperson_commission, sub_con_markup = :sub_con_markup, salesperson_edit_matrix = :salesperson_edit_matrix WHERE company_id=:company_id");
	
		$STH->bindParam(':overhead', $overhead);
		$STH->bindParam(':profit_margin', $profit_margin);
		$STH->bindParam(':salesperson_commission', $salesperson_commission);
		$STH->bindParam(':admin_cost', $admin_cost);
		$STH->bindParam(':sub_con_markup', $sub_con_markup);
		$STH->bindParam(':company_id', $company_id);
		$STH->bindParam(':salesperson_edit_matrix', $salesperson_edit_matrix);
		$STH->execute();
		
		$id = $DBH->lastInsertId();
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
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$STH = $DBH->prepare("INSERT INTO company ( overhead, profit_margin, salesperson_commission, admin_cost, sub_con_markup, company_id, salesperson_edit_matrix ) values ( :overhead, :profit_margin, :salesperson_commission, :admin_cost, :sub_con_markup, :company_id, :salesperson_edit_matrix )");

		$STH->bindParam(':overhead', $overhead);
		$STH->bindParam(':profit_margin', $profit_margin);
		$STH->bindParam(':salesperson_commission', $salesperson_commission);
		$STH->bindParam(':admin_cost', $admin_cost);
		$STH->bindParam(':sub_con_markup', $sub_con_markup);
		$STH->bindParam(':company_id', $company_id);
		$STH->bindParam(':salesperson_edit_matrix', $salesperson_edit_matrix);
		$STH->execute();

		$id = $DBH->lastInsertId();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}


echo "The entry was successfully added to the database";

?>