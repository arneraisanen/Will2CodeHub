<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$salesperson_id = $_SESSION['id'];
$client_id = $_SESSION['client_id'];
	
try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good FROM client WHERE id='$client_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}
 
$series_entries = '';
while($row = $STH->fetch())
{  
	$client_name1 = $row["name1"];
	$client_name2 =  $row["name2"];
	$client_address = $row["address"];
	$client_city = $row["city"];
	$client_state = $row["state"];
	$client_zip = $row["zip"];
	$client_phone1 = $row["phone1"];
	$client_phone2 = $row["phone2"];
	$client_email1 = $row["email"];
	$client_email2 = $row["email2"];
	$client_date = $row["date"];
	$client_rental = $row["rental"];
	$client_install = $row["install"];
	$client_work_desc_best = $row["best"];
	$client_work_desc_better = $row["better"];
	$client_work_desc_good = $row["good"];
}
	
?>