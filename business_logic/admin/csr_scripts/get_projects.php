<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, project_name FROM demo_feature_csr_projects ORDER BY project_name ASC");
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
	$series_entries .= '<option value="' . $row["project_name"] . '">' . $row["project_name"] . '</option>';
}

$DBH=null;
echo $series_entries;
?>