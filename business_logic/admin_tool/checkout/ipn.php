<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$payment_status = $_POST['payment_status'];
$reference_number = $_POST['invoice'];

$license_type = '';
$company_id= '';
$date = '';
$amount = '';

$one_month = '';
$three_month = '';
$six_month = '';
$twelve_month = '';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `one_month`, `three_month`, `six_month`, `twelve_month` FROM `license_prices` WHERE id='1'");
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$one_month = $row["one_month"];
	$three_month = $row["three_month"];
	$six_month = $row["six_month"];
	$twelve_month = $row["twelve_month"];
}


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `reference_number`, `date`, `amount`, `company_id` FROM `payments` WHERE reference_number=:reference_number");

	$STH->bindParam(':reference_number', $reference_number);
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	switch($row["amount"])
	{
		case $one_month:
			$license_type = '1 Month';
			break;
			
		case $three_month:
			$license_type = '3 Months';
			break;
			
		case $six_month:
			$license_type = '6 Months';
			break;
			
		case $twelve_month:
			$license_type = '12 Months';
			break;
	}

	$company_id = $row["company_id"];
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT `expiry_date` FROM `company_account` WHERE company_id=:company_id");
		$STH2->bindParam(':company_id', $company_id);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	
	while($row2 = $STH2->fetch())
	{
		$expiry_date = $row2["expiry_date"];
	}
	
	$expiry_date = date('Y-m-d', strtotime("+".$license_type, strtotime($expiry_date)));
	$last_payment = date('Y-m-d');
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("UPDATE company_account SET license_type = :license_type, expiry_date = :expiry_date, last_payment = :last_payment WHERE company_id=:company_id");
	
		$STH2->bindParam(':license_type', $license_type);
		$STH2->bindParam(':company_id', $company_id);
		$STH2->bindParam(':expiry_date', $expiry_date);
		$STH2->bindParam(':last_payment', $last_payment);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	$date_var = date('Y-m-d');
	
	if ($payment_status == 'Completed')
		$paid_var = 1;
	else 
		$paid_var = 0;
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("UPDATE payments SET date = :date, paid = :paid WHERE reference_number = :reference_number");
	
		$STH2->bindParam(':date', $date_var);
		$STH2->bindParam(':paid', $paid_var);
		$STH2->bindParam(':reference_number', $reference_number);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
?>