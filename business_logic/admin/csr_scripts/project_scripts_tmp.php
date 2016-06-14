<?php include "../../../global_paths.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
<title>CSR Scripts</title>
</head>
<body>
<div id="wrapperDiv">
	
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu_csr.php"; ?>
	
	<div class="requirment-techers">
		<div class="container">
			<div class="requirment-techers-you">
				<p style="font-size: 24px;">
					CSR Scripting System licensed by ARBCO LLC Coaching and Training Battle Ground WA 98604
				</p>
			</div>
		</div>
	</div>
	<div class="requirment-techers">
		<div class="container">
			<div class="requirment-techers-you">
				<p>
					CSR Scripts for: <span><?php echo $_GET['project_name']; ?></span>
				</p>
			</div>
		</div>
	</div>
	<div class="options-home">
		<div class="container"  style="width:800px;margin:auto;background-color:#fff;">
			<div class="row">
				<div class="jumbotron" id="project_scripts_display_box" style="background-color:#fff;">
				  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/csr_scripts/insert_first_script_tmp.php"; ?>
				</div>
			</div>
			
			<div class="row">
				<div class="jumbotron" id="project_scripts_display_box" style="background-color:#fff;">
				  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/csr_scripts/insert_input_boxes.php"; ?>
				</div>
			</div>
		</div>
	</div>

	<img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/images/call_centre.jpg">
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>
		
</div>
</body>
</html>