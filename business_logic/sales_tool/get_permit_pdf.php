<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT * FROM `permit` WHERE company_id='$company_id' AND proposal_id='$proposal_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$pull_permit = '';
$permit_type1 = '';
$permit_cost1 = '';
$permit_type2 = '';
$permit_cost2 = '';
$permit_type3 = '';
$permit_cost3 = '';
$permit_type4 = '';
$permit_cost4 = '';
$sales_tax = '';
$tax_exemption_number = '';
$special_instructions = '';

while($row = $STH->fetch())
{  
	$pull_permit = $row["pull_permit"];
	$permit_type1 = $row["type1"];
	$permit_cost1 = $row["cost1"];
	$permit_type2 = $row["type2"];
	$permit_cost2 = $row["cost2"];
	$permit_type3 = $row["type3"];
	$permit_cost3 = $row["cost3"];
	$permit_type4 = $row["type4"];
	$permit_cost4 = $row["cost4"];
	$sales_tax = $row["sales_tax"];
	$tax_exemption_number = $row["tax_exemption_number"];
	$special_instructions = $row["special_instructions"];
}
?>