<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin/get_company_details.php");
$company = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Add/Edit Company</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      	<script>
$(document).ready(
		function() {
			// Create a jqxDateTimeInput
			$("#field_5_add").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_6_add").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_5_add").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$("#field_6_add").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$("#field_5_update").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_6_update").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_5_update").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$("#field_6_update").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$('#jqxDateTimeInput').val(new Date());
		});
</script>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Add/Edit Company</h2>

        <section>
          
	    <div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div style="width:300px;">
								<?php echo $company ?>
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

<script src="<?php echo $website_root ?>/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script type="text/javascript" src="<?php echo $website_root ?>/js/jqxcore.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/jqxdatetimeinput.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/jqxcalendar.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/globalize.js"></script>
  </body>
</html>
