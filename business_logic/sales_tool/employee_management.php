<?php include "../../global_paths.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_header.php"; ?>
    <title>Employee Management</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Employee Management</h2>

          <section>
          <div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						
						<div class="email-form" id="edit_field" style="min-width: 800px;  margin-top: 50px;">
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="add_specialisation_show(1);">Add new employee</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="add_field" style="display:none;min-width: 800px;">
							<div style="width:300px;">
								Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
								Rate <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="add_specialisation_hide(1);">Cancel</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="add_employee_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
			</form>
		</div>
          
          <br /><br />
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Rate</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody> 
              	<?php include "get_employees_admin.php"; ?>
              </tbody>
            </table>
          </div>
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
