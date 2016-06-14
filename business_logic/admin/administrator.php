<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin/get_companies_list_administrator.php");
$companies_list = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Add/Edit Estimator Administrators</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Add/Edit Estimator Administrators</h2>

        <section>
          
	    <div class="container">	
	    
	    	<div class="row">
				<div class="col-sm-6">
											
					<div class="email-form" id="add_field" style="min-width: 800px;">
						<div style="width:50%;">
							<?php echo $companies_list ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
											
					<div class="email-form" id="add_field" style="min-width: 800px;">
						<div id="companies_list_item" style="width:100%;">
						</div>
					</div>
					<br /><br />
				</div>
			</div>
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div id="administrator_field" style="width:300px;">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		</section>
        </div>
      </div>
    </div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  </body>
</html>
