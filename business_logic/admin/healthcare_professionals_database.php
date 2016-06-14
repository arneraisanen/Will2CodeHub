<?php
session_start();
$website_root = 'http://'. $_SERVER['SERVER_NAME'] . '/';
$location = 'Location: ' . $website_root . 'business_logic/sign_in.php';

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
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Database of Healthcare Professionals</h2>

          <section>
			<br /><br />
			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Firstname</th>
						<th>Surname</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Mobile</th>
						<th>Specialisation</th>
						<th>Address1</th>
						<th>Address2</th>
						<th>Address3</th>
						<th>State</th>
						<th>Verified</th>
						<th>Published</th>
						<th>Edit</th>
					</tr>
				</thead>
			</table>
			<br /><br />
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
