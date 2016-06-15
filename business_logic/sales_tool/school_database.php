<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";
include('get_school_data.php');
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Schools DB Listing</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Database of Schools</h2>

          <section>
			<br /><br />
			
			<table id="schools_table" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Firstname</th>
						<th>Surname</th>
						<th>Email</th>
						<th>Phone</th>
						<th>School Name</th>
						<th>Address1</th>
						<th>Address2</th>
						<th>Address3</th>
						<th>Postcode</th>
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
