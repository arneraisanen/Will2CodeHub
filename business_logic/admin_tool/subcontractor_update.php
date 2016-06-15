<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id= $_POST['id'];
$name= $_POST['name'];
$trade_name= $_POST['trade_name'];
$rate= $_POST['rate'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE subcontractors SET name = :name, trade_name = :trade_name, rate = :rate WHERE id = :id");
	
	$STH->execute(array(
	':id' => $id,
	':name' => $name,
	':trade_name' => $trade_name,
	':rate' => $rate
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "Subcontractor details updated";

?>