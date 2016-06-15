<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$script_id= $_POST['script_id'];
$next_script_id= $_POST['next_script_id'];


try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("DELETE FROM demo_feature_csr_scripts_nextscript WHERE script_id = :script_id AND next_script_id = :next_script_id");
	
	$STH->bindParam(':script_id', $script_id);
	$STH->bindParam(':next_script_id', $next_script_id);
	$STH->execute();
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


echo "Entry deleted from DB";

?>