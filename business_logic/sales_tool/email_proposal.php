<?php

session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
require_once $doc_root.'/business_logic/phpmailer/class.phpmailer.php';
$company_id = $_SESSION['company_id'];

$salesperson_id = $_SESSION['id'];
$client_id = $_SESSION['client_id'];
$pdf_path = $_POST['pdf_path'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `company_id`, `email_text` FROM `pdf_email` WHERE company_id='$company_id'");
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
	$email_text =  $row["email_text"];
}


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, phone FROM salesperson WHERE id='$salesperson_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$salesperson_name = $row["name"];
	$salesperson_phone = $row["phone"];
}
	
try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name, address, phone, website, email, color, logo FROM company WHERE company_id='$company_id'");
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
	$company_name = $row["name"];
	$company_address = $row["address"];
	$company_phone = $row["phone"];
	$company_website = $row["website"];
	$company_email = $row["email"];
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name1, email, email2 FROM client WHERE id='$client_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}
 
$client_name1 = '';
$client_email1 = '';
$client_email2 = '';
$email_str = '';

while($row = $STH->fetch())
{  
	$client_name1 = $row["name1"];
	$client_email1 = $row["email"];
	$client_email2 = $row["email2"];
}

$bodytext = "Dear " . $client_name1 . ",\r\n" . $email_text . "\r\n\r\nIf you have any questions, then please do not hesitate to contact me, " . $salesperson_name . ", on either\r\nPh:" . $salesperson_phone . " or via email at:\r\n" . $company_email . "\r\n\nI look forward to your response and thank you for your time,\r\nBest regards,\r\n" . $salesperson_name;

if ($client_email2 != '')
	$email_str = $client_name1 . ' at ' . $client_email1 . ' and ' . $client_email2;
else 
	$email_str = $client_name1 . ' at '  . $client_email1;


$email = new PHPMailer();

$email->From      = $company_email;
$email->FromName  = $salesperson_name;
$email->Subject   = 'Work Proposal: ' . $company_name;
$email->Body      = $bodytext;
$email->AddAddress( $client_email1 );
$email->AddAddress( $client_email2 );

$file_to_attach = dirname($pdf_path);

$email->AddAttachment( $doc_root . $pdf_path );

$email->Send();	

echo 'Email sent';
?>