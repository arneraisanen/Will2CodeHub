<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, list_title FROM material_default_lists");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$default_list_select = '<select class="form-control" id="default_material_lists_id"><option value="">Select Default Material List</option>';
while($row = $STH->fetch())
{
	$default_list_select .= '<option value="' . $row["id"] . '">' . $row["list_title"] . '</option>';
}
$default_list_select .= '</select>';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, cost, description, ska FROM materials WHERE company_id='$company_id'");
	$STH->execute();
	
	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '    
  <table style="display:none;" id="materials_table_2" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th><abbr title="Stock Keeping Unit">SKU</abbr></th>
        <th>Description</th>
        <th>Cost</th>
        <th>Add</th>
      </tr>
	</thead>
	<tbody>';
$count = 1;
while($row = $STH->fetch())
{
	$series_entries .= '<tr style="display:none;" id="material_row_id_' . $row["id"] . '">
        <td>' . $count . '</td>
        <td>' . $row["id"] . '</td>
        <td style="width:10%;"><input id="field_5_update_' . $row["id"] . '" name="field_5_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["ska"] . '"/></td>
        <td style="width:50%;"><input id="field_4_update_' . $row["id"] . '" name="field_4_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["description"] . '"/></td>
        <td style="width:10%;"><input id="field_3_update_' . $row["id"] . '" name="field_3_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["cost"] . '"/></td>
        <td><button type="button" onclick="choose_materials_table(2, ' . $row["id"] . ');" class="btn btn-sm btn-success">Add</button></td></tr>';
	
	$count++;
}
$series_entries .= '

</tbody>
</table>';

$DBH=null;
echo $series_entries;
?>