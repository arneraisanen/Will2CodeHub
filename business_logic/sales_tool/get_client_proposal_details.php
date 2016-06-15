<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$client_id = $_POST['field_1_add'];
$_SESSION['client_id'] = $client_id;

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `name1`, `name2`, `address`, `city`, `state`, `zip`, `phone1`, `phone2`, `email`, `email2`, `date`, `rental`, `install`, `best`, `better`, `good`, `company_id`, `salesperson_id`, `proposal_id`, `notes` FROM `client` WHERE id='$client_id'");
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
	$client_date_formatted =  date("m-d-Y", strtotime($row["date"]));
	$install_date_formatted =  date("m-d-Y", strtotime($row["install"]));
	
	$_SESSION['proposal_id'] = $row["proposal_id"];
	$series_entries = $row["id"] . '<<<!separator!>>>' . $row["name1"] . '<<<!separator!>>>' . $row["name2"] . '<<<!separator!>>>' . $row["address"] . '<<<!separator!>>>' . $row["city"] . '<<<!separator!>>>' . $row["state"] . '<<<!separator!>>>' . $row["zip"] . '<<<!separator!>>>' . $row["phone1"] . '<<<!separator!>>>' . $row["phone2"] . '<<<!separator!>>>' . $row["email"] . '<<<!separator!>>>' . $row["email2"] . '<<<!separator!>>>' . $client_date_formatted . '<<<!separator!>>>' . $row["rental"] . '<<<!separator!>>>' . $install_date_formatted . '<<<!separator!>>>' . $row["best"] . '<<<!separator!>>>' . $row["better"] . '<<<!separator!>>>' . $row["good"] . '<<<!separator!>>>' . $row["company_id"] . '<<<!separator!>>>' . $row["salesperson_id"] . '<<<!separator!>>>' . $row["notes"];
}


echo $series_entries;