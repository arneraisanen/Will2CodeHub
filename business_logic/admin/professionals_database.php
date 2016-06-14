<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";
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
        <h2 class="sub-header">Database of Teachers</h2>

          <section>
			<br /><br />
			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>firstname</th>
						<th>surname</th>
						<th>email</th>
						<th>mobile</th>
						<th>subject</th>
						<th>address1</th>
						<th>address2</th>
						<th>address3</th>
						<th>state</th>
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
