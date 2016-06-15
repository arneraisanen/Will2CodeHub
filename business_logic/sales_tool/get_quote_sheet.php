<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT best, better, good, font, size FROM quote_sheet WHERE company_id='$company_id'");
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
	$series_entries .= '
	Best <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Better <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Good <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Font <input id="field_3_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Font Size <input id="field_3_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/>';
}

while($row = $STH->fetch())
{  
	$series_entries .= '
	Best <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["best"] . '"/>
	Better <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["better"] . '"/>
	Good <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["good"] . '"/>
	Font <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["font"] . '"/>
	Font Size <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["size"] . '"/>';
}

$DBH=null;
echo $series_entries;
?>