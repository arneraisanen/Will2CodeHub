<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$project_name= $_POST['project_name'];
$project_name_old= $_POST['project_name_old'];
$type_flag= $_POST['type_flag'];

if ($type_flag == 1)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE demo_feature_csr_projects SET project_name = :project_name WHERE project_name = :project_name_old");
		
		$STH->execute(array(
		':project_name' => $project_name,
		':project_name_old' => $project_name_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}

	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("UPDATE demo_feature_csr_scripts SET project_name = :project_name WHERE project_name = :project_name_old");
	
		$STH->execute(array(
				':project_name' => $project_name,
				':project_name_old' => $project_name_old
		));
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else if ($type_flag == 2)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE cities SET city = :specialisation WHERE city = :specialisation_old");
		
		$STH->execute(array(
		':specialisation' => $specialisation,
		':specialisation_old' => $specialisation_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else if ($type_flag == 3)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE state SET state = :specialisation WHERE state = :specialisation_old");
		
		$STH->execute(array(
		':specialisation' => $specialisation,
		':specialisation_old' => $specialisation_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

echo "DB list updated";

?>