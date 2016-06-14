<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin_tool/get_materials.php");
$materials = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_header.php"; ?>
    <title>Edit Materials List</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Edit Materials List</h2>

        <section>
          
	    <div class="container">	
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div style="width:100%;">
								<?php echo $materials ?>
							</div>
						</div>
					</div>
				</div>
		</div>
		
		<div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div style="width:50%;">
								Description <textarea id="text_1_add" name="text_1_add" class="form-control" data-trigger="focus" type="text"></textarea>
								Cost <input  style="width:20%;" id="text_2_add" name="text_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
							</div>
							<label>
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="add_company_materials(1);">Add Material Item</button>
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="color-master/js/tinycolor-0.9.15.min.js"></script>
<script src="color-master/js/pick-a-color-1.2.3.min.js"></script>
<script type="text/javascript">

   $(document).ready(function () {
    $(".pick-a-color").pickAColor();
   });

  </script>
  </body>
</html>
