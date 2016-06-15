<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, description FROM materials");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}



$series_entries = '<select onchange="choose_materials(1);" class="form-control" id="materials_proposal_platinum_id"><option value="">Choose Materials</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["description"] . '</option>';	
}
$series_entries .= '</select>';

$DBH=null;

echo $series_entries;
?>