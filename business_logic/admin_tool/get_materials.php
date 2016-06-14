<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$default_list_upload = '<div style="margin: 30px 0px; display:block;" id="edit_material_lists_form">
	<form action="update_materials_list.php" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
		<input class="form-control" data-trigger="focus" type="file" id="upload_file2" name="upload_file2" /><br />
		<label><div class="cancel-submit" style="padding:0px; float:right;"><input style="width: 100px;" class="form-control" data-trigger="focus" type="submit" name="submit_file2" value="Save" /></div></label>
	</form></div>';

$default_list_select = $default_list_upload;

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

$series_entries = $default_list_select . '<div class="container">     
  <table id="materials_table" class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th><abbr title="Stock Keeping Unit">SKU</abbr></th>
        <th>Description</th>
        <th>Cost</th>
        <th>Edit/Delete</th>
      </tr>
	</thead>
	<tbody>';

$series_entries .= '<div style="margin:30px;"><input onkeyup="search_materials_list();" id="search_materials" name="search_materials" class="form-control" data-trigger="focus" type="text" value="" placeholder="Search Materials" /></div>';

$count = 1;
while($row = $STH->fetch())
{
	$series_entries .= '<tr id="material_row_id_' . $row["id"] . '">
        <td>' . $count . '</td>
        <td>' . $row["id"] . '</td>
        <td style="width:10%;"><input id="field_5_update_' . $row["id"] . '" name="field_5_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["ska"] . '"/></td>
        <td style="width:50%;"><input id="field_4_update_' . $row["id"] . '" name="field_4_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["description"] . '"/></td>
        <td style="width:10%;"><input id="field_3_update_' . $row["id"] . '" name="field_3_add_' . $row["id"] . '" class="form-control" data-trigger="focus" type="text" value="' . $row["cost"] . '"/></td>
        <td><button type="button" onclick=add_edit_materials(0,' . $row["id"] . ') class="btn btn-sm btn-success">Update</button> | <button onclick=add_edit_materials(1,' . $row["id"] . ') type="button" class="btn btn-sm btn-danger">Delete</button></td></tr>';
	
	$count++;
}
$series_entries .= '

</tbody>
</table>
</div>';

$DBH=null;
echo $series_entries;
?>