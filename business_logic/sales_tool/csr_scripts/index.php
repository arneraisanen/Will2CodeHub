<?php
include "../../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($_SERVER['DOCUMENT_ROOT']."/business_logic/admin/csr_scripts/get_projects.php");
$project_name = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit CSR Project Scripts</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">CSR Project Scripts</h2>

        <section>
          
	    <div class="container" style="margin-top: 50px;">	
	    <fieldset style="border: 1px solid #ccc; padding: 10px;">
    		<legend style="width:inherit;border-bottom:none;">Project Management</legend>
			<form id="theform">
				<div class="row">
					<div class="col-sm-6" style="width: 100%;">
						<div class="email-form">
							<div style="float:left;">
								<select id="project_name" name="project_name" class="form-control">
									<?php echo $project_name; ?>
								</select>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="edit_csr_projects_show(1);" data-toggle="tooltip" data-placement="above" title="Edit the selected project name">Edit</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="edit_field" style="display:none;min-width: 800px;">
							<div style="float:left;">
								<input id="csr_projects" name="csr_projects" class="form-control" required="required" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_csr_projects_hide(1);">Cancel</button>
									</li>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_csr_projects_delete(1);">Delete</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="edit_csr_projects_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<br /><br />
						
						
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 0px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button style="margin-left: -15px;float: left;" id="registerBtn" type="button" onclick="add_csr_projects_show(1);">Add new project</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="add_field" style="display:none;min-width: 800px;">
							<div style="float:left;">
								<input id="add_csr_projects" name="csr_projects" class="form-control" required="required" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="add_csr_projects_hide(1);">Cancel</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="add_csr_projects_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
			</form>
		</fieldset>
		</div>
		
		
		<div class="container" style="margin-top: 20px;">	
	    <fieldset style="border: 1px solid #ccc; padding: 10px;">
    		<legend style="width:inherit;border-bottom:none;">Script Management</legend>
			<form id="theform2">
				<div class="row">
					<div class="col-sm-6" style="width: 100%;">
						<div class="email-form">
							<div style="float:left;">
								<select onchange="csr_project_scripts(1);" id="project_name_scripts" name="project_name_scripts" class="form-control">
									<?php echo $project_name; ?>
								</select>
							</div>
							<div style="float:left; margin-left:5px;">
								<select onchange="csr_project_scripts(1);" id="subproject_name_scripts" name="subproject_name_scripts" class="form-control">
									<option value="service">Service</option>
									<option value="sales">Sales</option>
									<option value="complaint">complaint</option>
									<option value="other">All Others</option>
								</select>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button style="margin-left: 15px;float: left;" id="registerBtn2" type="button" onclick="csr_project_scripts(1);">View/Edit Scripts</button>
									</li>
									<li>
										<button style="margin-left: 15px;float: left;" id="registerBtn" type="button" onclick="view_csr_projects(1);">View Project</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						
					</div>
				</div>
				
				<div class="row" id="project_scripts_box" style="display:none;">
					<div class="col-sm-6" style="width: 100%;">
						<div class="email-form" id="script_field" style="min-width: 800px;  margin-top: 0px;">
							
						</div>
					</div>
				
					<div class="col-sm-6" style="width: 100%;">
					<hr>
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 30px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button style="margin-left: -15px;" id="registerBtn3" type="button" onclick="input_script_row_show();">Add new script</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="row" id="input_script_row" style="display:none;">
					<div class="col-sm-4">
								<div class="">
									<div class="form-group location-select">
										<div class="form-group">
											<label for="comment">Script Text</label>
										  	<textarea class="form-control" rows="5" id="script_text_input_field"></textarea>
										</div>
									</div>
								</div>
							</div>
					<div class="col-sm-4">
						<div class="btn-group" data-toggle="buttons">
							<label class=""> First Script?
								<input id="first_script" type="checkbox" autocomplete="off" >
							</label>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 30px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button style="margin-left: -15px;" id="registerBtn4" type="button" onclick="add_new_script(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
					
					<div class="col-sm-2">
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 30px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button style="margin-left: -15px;" id="registerBtn4" type="button" onclick="input_script_row_hide();">Cancel</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
				
			</form>
		</fieldset>
		</div>
		
		
		
		</section>
        </div>
      </div>
    </div>


  </body>
</html>
