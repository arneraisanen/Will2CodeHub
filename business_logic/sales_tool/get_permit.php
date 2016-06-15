<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT * FROM `permit` WHERE company_id='$company_id' AND proposal_id='$proposal_id'");
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
	$series_entries .= '<table style="width: 100%; border-collapse: inherit; border-spacing: 20px;"><tbody>
			<tr><td>Company to pull permit</td><td><div class="radio">
  <label class="radio-inline"><input type="radio" name="optradio" id="optradio1">Yes</label>
</div>
<div class="radio">
  <label class="radio-inline"><input type="radio" name="optradio" id="optradio2" checked>No</label>
</div></td></tr>
	<tr><td>Permit Type <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/></td>
	<td style="">Permit Cost <input style="width:20%" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/></td></tr>
	<tr><td>Permit Type <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/></td>
	<td>Permit Cost <input style="width:20%" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/></td></tr>
	<tr><td>Permit Type <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/></td>
	<td>Permit Cost <input style="width:20%" id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value=""/></td></tr>
	<tr><td>Permit Type <input id="field_8_add" name="field_8_add" class="form-control" data-trigger="focus" type="text" value=""/></td>
	<td>Permit Cost <input style="width:20%" id="field_9_add" name="field_9_add" class="form-control" data-trigger="focus" type="text" value=""/></td></tr>
	<tr><td>Sales Tax <input style="width:20%" id="field_10_add" name="field_10_add" class="form-control" data-trigger="focus" type="text" value=""/></td><td></tr>
	<tr><td>Tax Exemption Number <input id="field_11_add" name="field_11_add" class="form-control" data-trigger="focus" type="text" value=""/></td><td></tr>
	<tr><td colspan="2">Special Instructions <textarea rows="6" id="field_12_add" name="field_12_add" class="form-control" data-trigger="focus" type="text"></textarea></td></tr>
	</tbody></table>';
}
while($row = $STH->fetch())
{  
	$pull_permit1 = '';
	$pull_permit2 = '';
	if ($row["pull_permit"])
		$pull_permit1 = 'checked';
	else 
		$pull_permit2 = 'checked';
	$series_entries .= '
	<table style="width: 100%; border-collapse: inherit; border-spacing: 20px;"><tbody>
	<tr><td>Company to pull permit</td><td><div class="radio">
  		<label class="radio-inline"><input type="radio" name="optradio" id="optradio1" ' . $pull_permit1 . '>Yes</label>
	</div>
	<div class="radio">
		<label class="radio-inline"><input type="radio" name="optradio" id="optradio2" ' . $pull_permit2 . '>No</label>
	</div></td></tr>
	<tr><td>Permit Type <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["type1"] . '"/></td>
	<td>Permit Cost <input style="width:20%;" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["cost1"] . '"/></td></tr>
	<tr><td>Permit Type <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["type2"] . '"/></td>
	<td>Permit Cost <input style="width:20%;" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["cost2"] . '"/></td></tr>
	<tr><td>Permit Type <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="' . $row["type3"] . '"/></td>
	<td>Permit Cost <input style="width:20%;" id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value="' . $row["cost3"] . '"/></td></tr>
	<tr><td>Permit Type <input id="field_8_add" name="field_8_add" class="form-control" data-trigger="focus" type="text" value="' . $row["type4"] . '"/></td>
	<td>Permit Cost <input style="width:20%;" id="field_9_add" name="field_9_add" class="form-control" data-trigger="focus" type="text" value="' . $row["cost4"] . '"/></td></tr>
	<tr><td>Sales Tax <input style="width:20%;" id="field_10_add" name="field_10_add" class="form-control" data-trigger="focus" type="text" value="' . $row["sales_tax"] . '"/></td><td></tr>
	<tr><td>Tax Exemption Number <input id="field_11_add" name="field_11_add" class="form-control" data-trigger="focus" type="text" value="' . $row["tax_exemption_number"] . '"/></td><td></tr>
	<tr><td colspan="2">Special Instructions <textarea rows="6" id="field_12_add" name="field_12_add" class="form-control" data-trigger="focus" type="text">' . $row["special_instructions"] . '</textarea></td></tr>
	</tbody></table>';
}

$DBH=null;
echo $series_entries;
?>