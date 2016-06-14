<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$best_label = 'Gold';
$better_label = 'Silver';
$good_label = 'Bronze';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, best, better, good FROM quote_sheet WHERE company_id='$company_id'");
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
	$best_label = $row["best"];
	$better_label = $row["better"];
	$good_label = $row["good"];
}

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, best, better, good, best_markup, better_markup, good_markup, company_id FROM guarantees WHERE company_id='$company_id'");
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
	$series_entries .= '' .
	$best_label . ' Guarantee <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text"></textarea>' .
	$best_label . ' Markup <input style="width:10%" id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/><br /><br />' .
	$better_label . ' Guarantee <textarea rows="8" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text"></textarea>' .
	$better_label . ' Markup <input style="width:10%" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/><br /><br />' .
	$good_label . ' Guarantee <textarea rows="8" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text"></textarea>' .
	$good_label . ' Markup <input style="width:10%" id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/><br /><br />';
}

while($row = $STH->fetch())
{  
	$series_entries .= '' .
	$best_label . ' Guarantee <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text">' . $row["best"] . '</textarea>' .
	$best_label . ' Markup <input style="width:10%" id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["best_markup"] . '"/><br /><br />' .
	$better_label . ' Guarantee <textarea rows="8" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text">' . $row["better"] . '</textarea>' .
	$better_label . ' Markup <input style="width:10%" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["better_markup"] . '"/><br /><br />' .
	$good_label . ' Guarantee <textarea rows="8" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text">' . $row["good"] . '</textarea>' .
	$good_label . ' Markup <input style="width:10%" id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="' . $row["good_markup"] . '"/><br /><br />';
}

$DBH=null;
echo $series_entries;
?>