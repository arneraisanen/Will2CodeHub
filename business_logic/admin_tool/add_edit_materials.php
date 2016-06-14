<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$action = $_POST['field_1_add'];
$id = $_POST['field_2_add'];
$cost = $_POST['field_3_add'];
$description = $_POST['field_4_add'];
$ska_var = $_POST['field_5_add'];

if ($action == 0)
{
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("UPDATE materials SET cost = :cost, description = :description, ska = :ska_var WHERE id=:id");
	
		$STH->bindParam(':cost', $cost);
		$STH->bindParam(':description', $description);
		$STH->bindParam(':ska_var', $ska_var);
		$STH->bindParam(':id', $id);
		$STH->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else 
{
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("DELETE FROM materials WHERE id = :id");
	
		$STH->bindParam(':id', $id);
		$STH->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

$series_entries = $action . '<<<!separator!>>>' . $id;
echo $series_entries;

?>