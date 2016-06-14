<?php
session_start();

define('DEBUG_SITE_START', 'false');

if (DEBUG_SITE_START == 'true')
	include_once "../global_paths.php";
else
	include_once "httpdocs/global_paths.php";

$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$email_master_admin = 'arne@arbco.us';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `company_id`, `reference_number`, `license_type`, `expired`, `expiry_date`, `joined`, `last_payment`, `recurring`, `termination_date` FROM `company_account` WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


while($row = $STH->fetch())
{
	$company_id_tmp = $row["company_id"];
	
	try 
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT name, contact_name, phone, email, credit_card_expiration, license_expiration FROM companies WHERE id='$company_id_tmp'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
		
	while($row2 = $STH2->fetch())
	{  
		$email_cust = $row2["email"];
		
		$subject_cust = "Arbco Estimator License Expiration Reminder";
		$subject_master_admin = "Arbco Estimator License Expiration Reminder for: " . $row2["contact_name"];
		
		$message_cust = "Dear " . $row2["contact_name"] . ",\n\rthis is a polite reminder that your Arbco Estimator Software license is due to expire on the " . $row2["license_expiration"] . ".\n\rPlease log into your account and update at your earliest convenience, so as to ensure a smooth uninterrupted service.\n\r\n\rBest Regards,\n\rArbco Estimation Software Management";
		
		$message_master_admin = 'Dear Arne' . ",\n\rthe following customer's license expires soon:\n\r\n\rCustomer Name: " . $row2["name"] . ",\n\rExpiray Date: " . $row2["license_expiration"] . "\n\r\n\rThe customer has been notified.\n\r\n\rBest regards, \n\rArbco Estimator Software Admin";
		
		mail($email_cust, $subject_cust, $message_cust);
		mail($email_master_admin, $subject_master_admin, $message_master_admin);
	}
}

?>