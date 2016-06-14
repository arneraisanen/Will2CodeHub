<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name FROM salesperson WHERE company_id='$company_id'");
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
	<form id="theform">
		<div class="row">
			<div class="col-sm-6">
				<div class="email-form" id="add_field" style="min-width: 800px;">
					<div style="width:300px;">';

$post_string1 = '</div>
					<label>
					<div class="cancel-submit" style="padding:0px; float:right;">
						<ul>
							<li>
								<button id="registerBtn" type="button" onclick="add_salesperson_save(1);">Save</button>
							</li>
						</ul>
					</div>
					</label>
				</div>
			</div>
		</div>
	</form>
</div>';

$post_string2 = '</div>
					<label>
					<div class="cancel-submit" style="padding:0px; float:right;">
						<ul>
							<li><a style="display:none;" id="cancelBtn2" href="#" onclick="update_salesperson_cancel();">Cancel</a></li>
							<li>
								<button style="display:none;" id="registerBtn2" type="button" onclick="update_salesperson();">Save</button>
							</li>
							<li>
								<button style="display:none; margin-top: 10px;" id="deleteBtn3" type="button" onclick="delete_salesperson();">Delete</button>
							</li>
						</ul>
					</div>
					</label>
				</div>
			</div>
		</div>
	</form>
</div>';

$series_entries = $pre_string . '<select onchange="edit_salesperson_get();" class="form-control" id="salesperson_id"><option value="">Edit Salesperson</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';	
}
$series_entries .= '</select><div style="margin: 30px 0px; display:none;" id="edit_salesperson_form">
	Name <input id="field_1_update" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Phone <input id="field_2_update" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Email <input id="field_3_update" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Commission <input id="field_7_update" name="field_7_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Proposal Initial No. <input id="field_8_update" name="field_8_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Password <input id="field_4_update" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Password Confirm <input id="field_6_update" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/>';

$DBH=null;
$series_entries .= $post_string2 . '</div>' . $pre_string . '<div style="font-size: 1.2em; margin: 40px 0px 10px;">Add New Salesperson</div><br />';
$series_entries .= '<div style="width:300px;">
	Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Phone <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Email <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Commission <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Proposal Initial No. <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Password <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Password Confirm <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/></div>' .$post_string1;

echo $series_entries;
?>