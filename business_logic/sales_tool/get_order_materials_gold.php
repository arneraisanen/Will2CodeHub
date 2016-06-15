<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, description FROM materials WHERE company_id = '$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}



$series_entries = '<select onchange="choose_materials(2);" class="form-control term" name="term-2" id="materials_proposal_gold_id"><option value="">Choose Materials</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["ska"] . ' | ' . $row["description"] . '</option>';	
}
$series_entries .= '</select><input id="search_materials_sales_2" placeholder="Search Materials" type="text" class="form-control search" name="search-2" />';

$DBH=null;

echo $series_entries;
?>