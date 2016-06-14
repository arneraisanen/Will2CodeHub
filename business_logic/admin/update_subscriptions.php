<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$one_month = $_POST['field_1_add'];
$three_month = $_POST['field_2_add'];
$six_month = $_POST['field_3_add'];
$twelve_month = $_POST['field_4_add'];
$id_var = 1;

try
{
  	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  	$STH = $DBH->prepare("UPDATE license_prices SET one_month = :one_month, three_month = :three_month, six_month = :six_month, twelve_month = :twelve_month WHERE id=:id_var");
  
  	$STH->bindParam(':id_var', $id_var);
  	$STH->bindParam(':one_month', $one_month);
  	$STH->bindParam(':three_month', $three_month);
  	$STH->bindParam(':six_month', $six_month);
  	$STH->bindParam(':twelve_month', $twelve_month);
  	$STH->execute();
}
catch(PDOException $e)
{
  	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
  	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
  	exit;
}

echo 'Paypal subscription prices updated';
?>