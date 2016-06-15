<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT best, better, good, best_markup, better_markup, good_markup, agreement FROM guarantees WHERE company_id='$company_id'");
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
	$guarantee_platinum = $row["best"];
	$guarantee_gold = $row["better"];
	$guarantee_basic = $row["good"];
	$guarantee_best_markup = $row["best_markup"];
	$guarantee_better_markup = $row["better_markup"];
	$guarantee_good_markup = $row["good_markup"];
	$guarantee_agreement = $row["agreement"];
}
?>