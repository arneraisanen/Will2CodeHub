<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$var1= $_POST['field_1_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM pdf_email WHERE company_id='$company_id'");
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
	
		$STH = $DBH->prepare("UPDATE pdf_email SET email_text = :email_text WHERE company_id=:company_id");
	
		$STH->bindParam(':email_text', $var1);
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
	
		$STH = $DBH->prepare("INSERT INTO `pdf_email`(`email_text`, `company_id`) VALUES (:email_text, :company_id)");
	
		$STH->bindParam(':email_text', $var1);
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