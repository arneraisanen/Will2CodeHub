<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php"; ?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>View Server Access Log</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Apache Access Log</h2><iframe src="viewer/index.php?log=<?php echo $_GET["log"] . '&url=' .$_GET["url"] ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="1000px"></iframe>
		</div>
      </div>
    </div>



  </body>
</html>