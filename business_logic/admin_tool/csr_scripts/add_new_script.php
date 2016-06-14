<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$project_name = $_POST['project_name'];
$sub_project= $_POST['subproject_name'];
$type_flag = $_POST['type_flag'];
$script_text  = $_POST['script_text'];
$first_script  = $_POST['first_script'];

if ($type_flag == 1)
{
	if ($first_script == 1)
	{
		try
		{
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
			$STH = $DBH->prepare("UPDATE demo_feature_csr_scripts SET first_script = 0 WHERE project_name = :project_name AND sub_project = :sub_project AND first_script = 1");
		
			$STH->execute(array(
			':project_name' => $project_name,
			':sub_project' => $sub_project
			));
		}
		catch(PDOException $e)
		{
			echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
			exit;
		}
	}
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("INSERT INTO demo_feature_csr_scripts ( project_name, sub_project, script, first_script ) values ( :project_name, :sub_project, :script, :first_script )");
	
		$STH->bindParam(':project_name', $project_name);
		$STH->bindParam(':sub_project', $sub_project);
		$STH->bindParam(':script', $script_text);
		$STH->bindParam(':first_script', $first_script);
		$STH->execute();
		
		$id = $DBH->lastInsertId();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}


echo "The script " . $specialisation . " was successfully added to the project/subproject \"" . $project_name . "/" . $sub_project . "\"";

?>