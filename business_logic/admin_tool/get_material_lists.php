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

$pre_string = '<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="email-form" id="add_field" style="min-width: 800px;">
					<div style="width:300px;">';

$post_string1 = '</div>
				</div>
			</div>
		</div>
</div>';

$post_string2 = '</div>
					<label>
					<div class="cancel-submit" style="padding:0px; float:right;">
						<ul>
							<li><a style="display:none;" id="cancelBtn2" href="#" onclick="update_material_lists_cancel();">Cancel</a></li>
							<li><a style="display:none;" id="cancelBtn3" href="#" onclick="update_material_lists_delete();">Delete</a></li>
						</ul>
					</div>
					</label>
				</div>
			</div>
		</div>
</div>';

$series_entries = $pre_string . '<select onchange="edit_material_lists_get();" class="form-control" id="material_lists_id"><option value="">Edit Default Material List</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["list_title"] . '</option>';	
}
$series_entries .= '</select><div style="margin: 30px 0px; display:none;" id="edit_material_lists_form">
	<form action="update_materials_list.php" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
		Material List Name <input id="field_1_update" name="field_1_update" class="form-control" data-trigger="focus" type="text" value=""/>
		<input id="field_2_update" name="field_2_update" class="form-control" data-trigger="focus" type="hidden" value=""/>
		<input class="form-control" data-trigger="focus" type="file" id="upload_file2" name="upload_file2" /><br />
		<label><div class="cancel-submit" style="padding:0px; float:right;"><input style="width: 100px;" class="form-control" data-trigger="focus" type="submit" name="submit_file2" value="Save" /></div></label>
	</form>';

$DBH=null;
$series_entries .= $post_string2 . '</div>' . $pre_string . '<div style="font-size: 1.2em; margin: 40px 0px 10px;">Add New Material List</div><br />';
$series_entries .= '<div style="width:300px;">
	<form action="upload_materials_list.php" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
		Material List Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
		<input class="form-control" data-trigger="focus" type="file" id="upload_file" name="upload_file" /><br />
		<label><div class="cancel-submit" style="padding:0px; float:right;"><input style="width: 100px;" class="form-control" data-trigger="focus" type="submit" name="submit_file" value="Save" /></div></label>
	</form>' .$post_string1;

echo $series_entries;
?>