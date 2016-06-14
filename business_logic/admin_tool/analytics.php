<?php
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Analytics</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Website Statistics</h2>
          <!-- <iframe src="/stats/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Dashboard&actionToWidgetize=index&idSite=1&period=week&date=yesterday&token_auth=dd887f2317ed90d220c45623e2ccdd60" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="4000px"></iframe> -->
          <iframe src="/stats/index.php?module=Login&action=logme&login=demo_user&password=6e9bece1914809fb8493146417e722f6" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="4000px"></iframe>
        </div>
      </div>
    </div>



  </body>
</html>
