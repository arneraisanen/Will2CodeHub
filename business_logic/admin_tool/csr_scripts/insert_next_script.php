<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id = $_POST['id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, project_name, script, next_script, first_script FROM demo_feature_csr_scripts WHERE id = :id");
	$STH->bindParam(':id', $id);
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$script_text = '<h2>Please use the following text:</h2>';
				
while($row = $STH->fetch())
{
	$script_text .= '<p>' . $row["script"] . '</p>';
	
	try
	{
		$DBHtmp = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBHtmp->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STHtmp = $DBHtmp->prepare("SELECT next_script_id, button_text FROM demo_feature_csr_scripts_nextscript WHERE script_id = :script_id ORDER BY next_script_id ASC");
		$STHtmp->bindParam(':script_id', $row["id"]);
		$STHtmp->execute();
	
		$STHtmp->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	}
	
	while($rowtmp = $STHtmp->fetch())
	{
		$script_text .= '<p><a style="float: left; margin: 20px 20px 20px 0px;" class="btn btn-primary btn-lg" onclick="insert_next_script(' . $rowtmp["next_script_id"] . ');" role="button">' . $rowtmp["button_text"] . '</a></p>';
	}
	
}

echo $script_text;
?>
				
