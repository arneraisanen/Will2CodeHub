<?php
session_start();
$website_root = 'http://'. $_SERVER['SERVER_NAME'] . '/';
$location = 'Location: ' . $website_root . 'business_logic/sign_in.php';

if ( isset($_SESSION["custom_dir"]) )
	$custom_dir_var = $_SESSION["custom_dir"];

ob_start();
include($_SERVER['DOCUMENT_ROOT']."/business_logic/doctors_admin/get_doctor_specialisations.php");
$doctor_specialisations = ob_get_contents();
ob_end_clean();

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "admin" )
	{
		header($location);
		exit; 
	}
}
else
{
	header($location);
	exit;
}
include('get_log_data.php');
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Admin DB Listing</title>
    <script src="<?php echo $website_root ?>/business_logic/process/ajax.js"></script>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Image Repository</h2>

          <section>
			<br /><br />
			Folder: 
			<select id="image_folder" name="specialisation" class="form-control" onchange="set_image_folder_dir()">
			    <?php echo $doctor_specialisations ?>
			</select><br /><br />
			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Size (KB)</th>
						<th>Tags</th>
						<th>Folder</th>
						<th>Edit</th>
					</tr>
				</thead>
			</table>
			<br /><br />
		</section>
        </div>
      </div>
    </div>
	
	<script>
$(document).ready(function() {
	var element = document.getElementById('image_folder');
    element.value = '<?php echo $custom_dir_var ?>';
});
</script>
  </body>
</html>
