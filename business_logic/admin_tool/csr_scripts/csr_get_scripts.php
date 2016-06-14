<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$project_name= $_POST['project_name'];
$sub_project= $_POST['subproject_name'];
$type_flag= $_POST['type_flag'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT introtext FROM demo_feature_csr_projects WHERE project_name = '$project_name'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$introtext = $row["introtext"];
	
	if ($introtext == '')
		$introtext = 'First page intro text';
}

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, project_name, sub_project, script, next_script, first_script FROM demo_feature_csr_scripts WHERE project_name = '$project_name' AND sub_project = '$sub_project' ORDER BY first_script DESC");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

if ($STH->rowCount() == 0)
{
	echo 'No data ';
	exit;
}
$series_entries .= '<textarea id="csr_input_introtext" class="form-control" rows="5">' . $introtext . '</textarea><button style="float: right; margin-bottom: 40px;" class="btn btn-info btn-lg" id="registerBtn" type="button" onclick="add_intro_text(\'' . $project_name . '\');">Save</button>';
$series_entries .= '<table style="margin: 30px 5px;" id="schools_table" class="display" cellspacing="10" width="100%">
				<thead>
					<tr>
						<th style="width:10%">ID</th>
						<th style="width:15%">First Script</th>
						<th>Script Text</th>
						<th style="width:10%">Next Scripts</th>
					</tr>
				</thead>';

$count = 0;
while($row = $STH->fetch())
{  
	$next_script_array = array();
	$row_id_var = $row["id"];
	$DBHtmp=null;
	$STHtmp=null;
	
	try
	{
		$DBHtmp = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBHtmp->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STHtmp = $DBHtmp->prepare("SELECT id FROM demo_feature_csr_scripts WHERE project_name = :project_name AND sub_project = :sub_project ORDER BY id ASC");
		$STHtmp->bindParam(':project_name', $project_name);
		$STHtmp->bindParam(':sub_project', $sub_project);
		$STHtmp->execute();
	
		$STHtmp->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		//exit;
	}
	
	$project_script_list = '<select id="project_scripts_list_' . $count . '" name="project_scripts_list_' . $count . '" class="form-control">';
	while($rowtmp = $STHtmp->fetch())
	{
		$project_script_list .= '<option value="' . $rowtmp["id"] . '">' . $rowtmp["id"] . '</option>';
	}
	$project_script_list .= '</select>';
	
	try
	{
		$DBHtmp = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBHtmp->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STHtmp = $DBHtmp->prepare("SELECT next_script_id FROM demo_feature_csr_scripts_nextscript WHERE script_id = :script_id ORDER BY next_script_id ASC");
		$STHtmp->bindParam(':script_id', $row_id_var);
		$STHtmp->execute();
	
		$STHtmp->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		//exit;
	}
	while($rowtmp = $STHtmp->fetch())
	{
		array_push($next_script_array, $rowtmp["next_script_id"]);
	}
	
	//xdebug_break();
	//$nextscripts_str = $STHtmp->rowCount() . ', ' . $count;
	if ($STHtmp->rowCount() != 0)
		$nextscripts_str = implode(',', $next_script_array);
	else 
		$nextscripts_str = 'None';
	
	if ($row["first_script"])
	{
		$first_script = '<div id="project_name_scripts_firstscript_placeholder_' . $count . '" onclick="csr_project_scripts_update_firstscript_placeholder(' . $count . ');">Yes</div>';
		$first_script .= '<select style="display:none;" onchange="csr_project_scripts_update_firstscript(' . $count . ');" id="project_name_scripts_firstscript_' . $count . '" name="project_name_scripts_firstscript_' . $count . '" class="form-control">';
		$first_script .= '<option SELECTED value=""></option>';
		$first_script .= '<option value="No">No</option>';
		$first_script .= '<option value="Yes">Yes</option>';
		$first_script .= '</select>';
	}
	else 
	{
		$first_script = '<div id="project_name_scripts_firstscript_placeholder_' . $count . '" onclick="csr_project_scripts_update_firstscript_placeholder(' . $count . ');">No</div>';
		$first_script .= '<select style="display:none;" onchange="csr_project_scripts_update_firstscript(' . $count . ');" id="project_name_scripts_firstscript_' . $count . '" name="project_name_scripts_firstscript_' . $count . '" class="form-control">';
		$first_script .= '<option SELECTED value=""></option>';
		$first_script .= '<option value="No">No</option>';
		$first_script .= '<option value="Yes">Yes</option>';
		$first_script .= '</select>';
	}
	
	$script_textarea = '<div id="script_text_input_field_edit_placeholder_' . $count . '" onclick="csr_project_scripts_update_scripttext_placeholder(' . $count . ');">' . $row["script"] . '</div><div style="display:none" id="script_text_input_field_edit_textarea_div_' . $count . '"><textarea class="form-control" rows="5" id="script_text_input_field_edit_' . $count . '">' . $row["script"] . '</textarea>
			<label>
			<div class="cancel-submit" style="padding:0px; float:right;">
				<ul>
					<li>
						<button id="cancelBtn" type="button" onclick="add_csr_scripttext_hide(' . $count . ');">Cancel</button>
					</li>
					<li>
						<button id="registerBtn" type="button" onclick="add_csr_scripttext_save(' . $count . ');">Save</button>
					</li>
					<li>
						<button id="deleteBtn" type="button" onclick="add_csr_scripttext_delete(' . $count . ');">Delete</button>
					</li>
				</ul>
			</div>
			</label></div>';
	

	//$next_script_array = explode(',', $row["next_script"]);
	$next_scripts_table = '<table style="margin: 30px 5px;" id="schools_table" class="display" cellspacing="10" width="100%">
			<thead>
				<tr>
					<th style="width:40%;height: 60px;">Next Script ID</th>
					<th style="text-align: right;height: 60px;">Action</th>
				</tr>
			</thead>';
	
	$row_count = 0;
	foreach ($next_script_array as $next_script_array_element)
	{
		$next_scripts_table .= '<tr id="nextscript_table_delete_row_' . $row_count . '"><td>' . $next_script_array_element . '</td><td style="text-align: right;"><label>
		<div class="cancel-submit" style="padding:0px; float:right;">
			<ul>
				<li>
					<button id="cancelBtn' . $row_count . '" type="button" onclick="csr_nextscript_delete(' . $row_count . ', ' . $row["id"] . ', ' . $next_script_array_element . ');">Delete</button>
				</li>
			</ul>
		</div>
		</label></td></tr>';
		$row_count++;
	}
	
	$next_scripts_table .= '<tr><td style="height: 30px;"></td><td></td></tr>
	<tr id="add_nextscript_input_button_' . $count . '">
		<td></td>
		<td>
			<div class="cancel-submit" style="padding:0px; float:right;">
				<ul>
					<li>
						<button id="cancelBtn' . $count . '" type="button" onclick="csr_nextscript_show_add(' . $count . ');">Add Next Script</button>
					</li>
				</ul>
			</div>
		</td>
	</tr>';
	
	$next_scripts_table .= '</table>';
	
	$next_scripts_table .= '
	<table style="margin: 30px 5px;display:none;" id="add_nextscript_input_box_' . $count . '"" class="display" cellspacing="10" width="100%">
	<thead>
	<tr>
	<th style="width:50%">Button Text</th>
	<th style="width:25%"></th>
	<th style="width:25%">Next Script ID</th>
	</tr>
	</thead>
	<tr>
	<td><input id="add_nextscript_input_id_' . $count . '" name="add_nextscript_input_id_' . $count . '" class="form-control" type="text" value="Enter button text"/></td>
	<td></td>
	<td>' . $project_script_list . '</td>
	</tr>
	<tr>
	<td></td>
	<td colspan="2"><div class="cancel-submit" style="padding:0px; float:right;"><button id="cancelBtn" type="button" onclick="csr_nextscript_cancel(' . $count . ');">Cancel</button>
	<div class="cancel-submit" style="padding:0px; float:right;"><button id="cancelBtn' . $count . '" type="button" onclick="csr_nextscript_add(' . $count . ', ' . $row["id"] . ');">Save</button></td>
	</tr>
	</table>';

	
	$script_nextscript = '<button id="nextscript_input_field_edit__placerholder' . $count . '" onclick="csr_project_scripts_update_nexttext_placeholder(' . $count . ');" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#my_modal_' . $count . '">' . $nextscripts_str . '</button>
						<div style="display:none" id="nextscript_input_field_edit_' . $count . '">
							  <!-- Modal -->
							  <div class="modal fade" id="my_modal_' . $count . '" role="dialog">
							    <div class="modal-dialog">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Script ID: ' . $row["id"] . '</h4>
							        </div>
							        <div class="modal-body">
							          <p><table>' . $next_scripts_table . '</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>
							      </div>
							      
							    </div>
							  </div>
							  
						</div>';
	
	$series_entries .= '<tr id="script_text_input_field_edit_placeholder_row_' . $count . '"><td style="padding: 2em 0em;"><div id="project_name_scripts_firstscript_id_' . $count . '">' . $row["id"] . '</div></td><td style="padding: 2em 1em 2em 0em">' . $first_script . '</td><td style="padding: 2em 1em 2em 0em;">' . $script_textarea . '</td><td style="padding: 2em 0em;">' . $script_nextscript . '</td></tr>';
	
	$count++;
}
$series_entries .= '</table>';


$DBH=null;
echo $series_entries;
?>