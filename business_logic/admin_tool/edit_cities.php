<?php
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";
ob_start();
include($doc_root."/business_logic/user_admin/get_cities.php");
$cities = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Cities</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Edit Cities</h2>

        <section>
          
	    <div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
						<div class="email-form">
							<div style="float:left;">
								<select id="specialisation_old" name="specialisation_old" class="form-control">
									<?php echo $cities ?>
								</select>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="edit_specialisation_show(2);">Edit</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="edit_field" style="display:none;min-width: 800px;">
							<div style="float:left;">
								<input id="specialisation" name="specialisation" class="form-control" required="required" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_specialisation_hide(2);">Cancel</button>
									</li>
									<li>
										<button id="cancelBtn" type="button" onclick="edit_specialisation_delete(2);">Delete</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="edit_specialisation_save(2);">Save</button>
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
										<button id="registerBtn" type="button" onclick="add_specialisation_show(2);">Add new entry</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
						
						<div class="email-form" id="add_field" style="display:none;min-width: 800px;">
							<div style="float:left;">
								<input id="add_specialisation" name="specialisation" class="form-control" required="required" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="cancelBtn" type="button" onclick="add_specialisation_hide(2);">Cancel</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="add_specialisation_save(2);">Save</button>
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
