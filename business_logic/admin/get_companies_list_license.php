<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name FROM companies");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '<select onchange="set_companies_session_license();" class="form-control" id="companies_list_id"><option value="">Select Company</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';	
}
$series_entries .= '</select>';


echo $series_entries;
?>