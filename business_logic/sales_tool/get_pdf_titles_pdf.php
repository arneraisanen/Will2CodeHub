<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `company_id`, `work`, `materials`, `sub_contractors`, `guarantee`, `agreement`, `terms`, `instruction` FROM `pdf_titles` WHERE company_id='$company_id'");
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
	$work = $row["work"];
	$materials = $row["materials"];
	$sub_contractors = $row["sub_contractors"];
	$guarantee = $row["guarantee"];
	$agreement = $row["agreement"];
	$investment = $row["terms"];
	$instructions = $row["instruction"];
}
?>