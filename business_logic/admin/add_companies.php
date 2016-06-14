<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$name1= $_POST['field_1_add'];
$name2= $_POST['field_2_add'];
$name3= $_POST['field_3_add'];
$name4= $_POST['field_4_add'];

$_POST['field_5_add'] = implode('/', array_reverse(explode('/', $_POST['field_5_add'])));
$name5= date("Y-m-d", strtotime(str_replace('-', '/', $_POST['field_5_add'])));

$_POST['field_6_add'] = implode('/', array_reverse(explode('/', $_POST['field_6_add'])));
$name6= date("Y-m-d", strtotime(str_replace('-', '/', $_POST['field_6_add'])));

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("INSERT INTO companies ( name, contact_name, phone, email, credit_card_expiration, license_expiration ) values ( :name, :contact_name, :phone, :email, :credit_card_expiration, :license_expiration )");

	$STH->bindParam(':name', $name1);
	$STH->bindParam(':contact_name', $name2);
	$STH->bindParam(':phone', $name3);
	$STH->bindParam(':email', $name4);
	$STH->bindParam(':credit_card_expiration', $name5);
	$STH->bindParam(':license_expiration', $name6);
	$STH->execute();
	
	$id_tmp = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


$rand_num = rand(1000, 9999);
$reference_number = 'arbco' . $rand_num . 'est' . $id_tmp;
$license_type = 'trial';
$expired = 0;
$joined = date('Y-m-d');
$termination_date = date('Y-m-d');
$expiry_date = $name6;

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO company_account ( company_id, reference_number, license_type, expired, joined, termination_date, expiry_date ) values ( :company_id, :reference_number, :license_type, :expired, :joined, :termination_date, :expiry_date )");

	$STH->bindParam(':company_id', $id_tmp);
	$STH->bindParam(':reference_number', $reference_number);
	$STH->bindParam(':license_type', $license_type);
	$STH->bindParam(':expired', $expired);
	$STH->bindParam(':expiry_date', $expiry_date);
	$STH->bindParam(':joined', $joined);
	$STH->bindParam(':termination_date', $termination_date);
	
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "The entry was successfully added to the database";

?>