<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$salesperson_id = $_SESSION['id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, commission, proposal_init_number, phone FROM salesperson WHERE id='$salesperson_id'");
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
	$company_salesperson_commission = $row["commission"];
	$proposal_init_number = $row["proposal_init_number"];
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("UPDATE salesperson SET proposal_init_number=proposal_init_number+1 WHERE id='$salesperson_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}
?>