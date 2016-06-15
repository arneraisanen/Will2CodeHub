<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, material_id, quantity FROM proposal WHERE company_id='$company_id' AND proposal_id='$proposal_id' AND type_field='basic'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '<table id="materials_proposal_add_table_basic" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Delete</th>
      </tr>
	</thead>
	<tbody>';
$count = 1;
while($row = $STH->fetch())
{
	$material_id = $row["material_id"];
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT id, cost, description FROM materials WHERE id='$material_id'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	while($row2 = $STH2->fetch())
	{
	$series_entries .= '<tr id="material_proposal_row_' . $row["id"] . '">
        <td>' . $count . '</td>
        <td>' . $row2["id"] . '</td>
        <td>' . $row2["description"] . '</td>
        <td style="width:10%"><input style="width:70%" id="quantity_value_' . $row["id"] . '" onchange="add_quantity_to_proposal(\'' . $row["id"] . '\')" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="' . $row["quantity"] . '"/></td>
        <td><button onclick="delete_material_proposal(\'' . $row["id"] . '\')" type="button" class="btn btn-danger">Delete</button></td></tr>';
	}
	
	$count++;
}
$series_entries .= '

</tbody>
</table>';

$DBH=null;
echo $series_entries;
?>