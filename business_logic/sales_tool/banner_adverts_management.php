<?php include "../../global_paths.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Banner Adverts Management</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Banner Adverts</h2>

          <section>
          <br /><br />
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Link</th>
                  <th>Image</th>
                  <th>Position</th>
                  <th>Expires</th>
                  <th>Edit/Delete</th>
                </tr>
              </thead>
              <tbody> 
              	<?php include "get_banner_adverts_admin.php"; ?>
              </tbody>
            </table>
          </div>
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
