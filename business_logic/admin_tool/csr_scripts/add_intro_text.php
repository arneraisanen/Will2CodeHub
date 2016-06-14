<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$project_name= $_POST['project_name'];
$introtext= $_POST['introtext'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE demo_feature_csr_projects SET introtext = :introtext WHERE project_name = :project_name");
	
	$STH->execute(array(
	':project_name' => $project_name,
	':introtext' => $introtext
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}



echo "DB list updated";

?>