<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$name= $_POST['field_1_add'];
$address= $_POST['field_2_add'];
$phone= $_POST['field_3_add'];
$website= $_POST['field_4_add'];
$email= $_POST['field_5_add'];
$color= $_POST['field_6_add'];

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
	
		$STH = $DBH->prepare("UPDATE company SET name = :name, address = :address, phone = :phone, website = :website, email = :email, color = :color WHERE company_id=:company_id");
	
		$STH->bindParam(':name', $name);
		$STH->bindParam(':address', $address);
		$STH->bindParam(':phone', $phone);
		$STH->bindParam(':website', $website);
		$STH->bindParam(':email', $email);
		$STH->bindParam(':company_id', $company_id);
		$STH->bindParam(':color', $color);
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
	
		$STH = $DBH->prepare("INSERT INTO company ( name, address, phone, website, email, company_id, color ) values ( :name, :address, :phone, :website, :email, :company_id, :color )");
	
		$STH->bindParam(':name', $name);
		$STH->bindParam(':address', $address);
		$STH->bindParam(':phone', $phone);
		$STH->bindParam(':website', $website);
		$STH->bindParam(':email', $email);
		$STH->bindParam(':company_id', $company_id);
		$STH->bindParam(':color', $color);
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