<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin/csr_scripts/get_projects.php");
$projects = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/admin/get_users.php");
$users = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Dashboard Users</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Edit Dashboard Users</h2>

        <section>
          
	    <div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						<div class="email-form">
							<div style="float:left;">
								<select id="specialisation_old" name="specialisation_old" class="form-control"  onchange="edit_users_show(1);">
									<?php echo $users ?>
								</select>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="edit_users_show(1);">Edit</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="edit_field" style="display:none;min-width: 800px;">
							<div id="edit_user_details_field" style="width: 300px;">
								
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_specialisation_hide(1);">Cancel</button>
									</li>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_user_delete(1);">Delete</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="edit_user_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<br /><br />
						
						
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 50px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="add_specialisation_show(1);">Add new entry</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="add_field" style="display:none;min-width: 800px;">
							<div style="width:300px;">
								Username <input id="csr_username_add" name="csr_username_add" class="form-control" data-trigger="focus" type="text" value=""/>
								Password <input id="csr_password_add" name="csr_password_add" class="form-control" data-trigger="focus" type="text" value=""/>
								Firstname <input id="csr_firstname_add" name="csr_firstname_add" class="form-control" data-trigger="focus" type="text" value=""/>
								Surname <input id="csr_surname_add" name="csr_surname_add" class="form-control" data-trigger="focus" type="text" value=""/>
								Role <select class="form-control" id="csr_role_add"><option value="admin">Admin</option><option value="professional">Professional</option><option SELECTED value="user">User</option></select>
								Project <select id="csr_project_add" name="csr_project_add" class="form-control"><?php echo $projects ?></select> 
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="add_specialisation_hide(1);">Cancel</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="add_user_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
			</form>
		</div>
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
