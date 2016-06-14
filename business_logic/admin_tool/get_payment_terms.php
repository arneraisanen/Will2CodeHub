<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, payment_terms FROM guarantees WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '';   

if ($STH->rowCount() == 0)
{
	$series_entries .= 'Payment Terms <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text"></textarea><br /><br />';
}

while($row = $STH->fetch())
{  
	$series_entries .= 'Payment Terms <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text">' . $row["payment_terms"] . '</textarea><br /><br />';
}

$DBH=null;
echo $series_entries;
?>