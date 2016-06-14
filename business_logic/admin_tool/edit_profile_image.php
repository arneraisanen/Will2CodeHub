<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Profile Image</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Upload and Edit Profile Image</h2>

          <!-- <iframe src="jcrop/index.php?id=<?php echo $id ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="900px"></iframe>-->
          <iframe src="cropper-master/examples/crop-avatar/save_profile_image.php?id=<?php echo $id ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="900px"></iframe>
        </div>
      </div>
    </div>



  </body>
</html>
