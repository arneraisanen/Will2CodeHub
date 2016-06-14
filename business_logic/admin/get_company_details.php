<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name FROM companies");
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
								<button id="registerBtn" type="button" onclick="add_companies_save(1);">Save</button>
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
							<li><a style="display:none;" id="cancelBtn2" href="#" onclick="update_companies_cancel();">Cancel</a></li>
							<li>
								<button style="display:none;" id="registerBtn2" type="button" onclick="update_companies();">Save</button>
							</li>
						</ul>
					</div>
					</label>
				</div>
			</div>
		</div>
	</form>
</div>';

$series_entries = $pre_string . '<select onchange="edit_companies_get();" class="form-control" id="companies_id"><option value="">Edit Company</option>';                         
while($row = $STH->fetch())
{  
	$series_entries .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';	
}
$series_entries .= '</select><div style="margin: 30px 0px; display:none;" id="edit_companies_form">
	Company Name <input id="field_1_update" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Contact Name <input id="field_2_update" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Phone <input id="field_3_update" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Email <input id="field_4_update" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Credit Card Expiration 
		<div class="date-pic">
			<div id="field_5_update"> </div>
			<input id="dob3" name="dateOfBirth3" type="hidden" value=""/>
		</div>
	License Expiration
		<div class="date-pic">
			<div id="field_6_update"> </div>
			<input id="dob4" name="dateOfBirth4" type="hidden" value=""/>
		</div>';

$DBH=null;
$series_entries .= $post_string2 . '</div>' . $pre_string . '<div style="font-size: 1.2em; margin: 40px 0px 10px;">Add New Company</div><br />';
$series_entries .= '<div style="width:300px;">
	Company Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Contact Name <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Phone <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Email <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Credit Card Expiration 
		<div class="date-pic">
			<div id="field_5_add"> </div>
			<input id="dob" name="dateOfBirth" type="hidden" value=""/>
		</div>
	License Expiration
		<div class="date-pic">
			<div id="field_6_add"> </div>
			<input id="dob2" name="dateOfBirth2" type="hidden" value=""/>
		</div></div>' .$post_string1;

echo $series_entries;
?>