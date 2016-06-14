<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin/edit_subscriptions.php");
$subscriptions = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Add/Edit Paypal Subscriptions</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Add/Edit Paypal Subscriptions</h2>

        <section>
          
	    <div class="container">	
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div style="width:300px;">
								<?php echo $subscriptions ?>
							</div>
						</div>
						
						<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="update_subscriptions();">Save</button>
									</li>
								</ul>
							</div>
						</label>
					</div>
				</div>
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
