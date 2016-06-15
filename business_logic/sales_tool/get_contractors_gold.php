<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, trade_name, rate, description FROM subcontractors WHERE company_id='$company_id' AND proposal_id='$proposal_id' AND package_type='gold' ORDER BY id ASC");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";

	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '<div class="container" style="padding: 10px;">     
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Trade Name</th>
        <th>Proposal Amount</th>
        <th style="width: 30%;">Description</th>
      </tr>';
$count = 1;
while($row = $STH->fetch())
{
	$series_entries .= '<tr>
        <td>' . $count . '</td>
        <td><input onkeyup="add_contractor_desc(\'' . $row["id"] . '\', 2)" id="field_1_2_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["name"] . '"/></td>
       	<td><input onkeyup="add_contractor_desc(\'' . $row["id"] . '\', 2)" id="field_2_2_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["trade_name"] . '"/></td>
        <td><input onkeyup="add_contractor_desc(\'' . $row["id"] . '\', 2)" id="field_3_2_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["rate"] . '"/></td>
        <td><textarea rows="1" id="field_4_2_' . $row["id"] . '" onkeyup="add_contractor_desc(\'' . $row["id"] . '\', 2)" name="gold_1_add" class="form-control" data-trigger="focus" type="text">' .  $row["description"] . '</textarea></td>
		<td style="width: 18%;padding-left: 10px;"><label><div class="cancel-submit" style="padding:0px; float:right;"><button id="registerBtn" type="button" onclick="delete_subcontractor(\'' . $row["id"] . '\')">Delete</button></div></label></td>';
	
	$count++;
}
$series_entries .= '</thead>
<tbody>
</tbody>
</table>
</div>';

echo $series_entries;