<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$var1= $_POST['field_1_add'];
$var2= $_POST['field_2_add'];
$var3= $_POST['field_3_add'];
$var4= $_POST['field_4_add'];
$var5= $_POST['field_5_add'];
$var6= $_POST['field_6_add'];
$var7= $_POST['field_7_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM pdf_titles WHERE company_id='$company_id'");
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
	
		$STH = $DBH->prepare("UPDATE pdf_titles SET work = :work, materials = :materials, sub_contractors = :sub_contractors, guarantee = :guarantee, agreement = :agreement, terms = :terms, instruction = :instruction WHERE company_id=:company_id");
	
		$STH->bindParam(':work', $var1);
		$STH->bindParam(':materials', $var2);
		$STH->bindParam(':sub_contractors', $var3);
		$STH->bindParam(':guarantee', $var4);
		$STH->bindParam(':agreement', $var5);
		$STH->bindParam(':terms', $var6);
		$STH->bindParam(':instruction', $var7);
		$STH->bindParam(':company_id', $company_id);
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
	
		$STH = $DBH->prepare("INSERT INTO `pdf_titles`(`work`, `materials`, `sub_contractors`, `guarantee`, `agreement`, `terms`, `instruction`, `company_id`) VALUES (:work, :materials, :sub_contractors, :guarantee, :agreement, :terms, :instruction, :company_id)");
	
		$STH->bindParam(':work', $var1);
		$STH->bindParam(':materials', $var2);
		$STH->bindParam(':sub_contractors', $var3);
		$STH->bindParam(':guarantee', $var4);
		$STH->bindParam(':agreement', $var5);
		$STH->bindParam(':terms', $var6);
		$STH->bindParam(':instruction', $var7);
		$STH->bindParam(':company_id', $company_id);
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

echo "The PDF titles were successfully added to the database";

?>