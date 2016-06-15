<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `company_id`, `work`, `materials`, `sub_contractors`, `guarantee`, `agreement`, `terms`, `instruction` FROM `pdf_titles` WHERE company_id='$company_id'");
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
	Work to be performed <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="Work to be performed"/>
	Materials <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="Materials"/>
	Sub Contractors <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="Sub Contractors"/>
	Guarantee <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="Guarantee"/>
	Legal Agreement & Terms <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="Legal Agreement & Terms"/>
	Investment Terms <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="Investment Terms"/>
	Special Instructions <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value="Special Instructions"/>';
}

while($row = $STH->fetch())
{  
	$series_entries .= '
	Work to be performed <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["work"] . '"/>
	Materials <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["materials"] . '"/>
	Sub Contractors <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["sub_contractors"] . '"/>
	Guarantee <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["guarantee"] . '"/>
	Legal Agreement & Terms <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["agreement"] . '"/>
	Investment Terms <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="' . $row["terms"] . '"/>
	Special Instructions <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value="' . $row["instruction"] . '"/>';
}

$DBH=null;
echo $series_entries;
?>