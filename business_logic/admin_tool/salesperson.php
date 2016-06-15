<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

ob_start();
include($doc_root."/business_logic/admin_tool/get_salespeople.php");
$salesperson = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_header.php"; ?>
    <title>Add/Edit Salesperson</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Add/Edit Salesperson</h2>

        <section>
	    	<?php echo $salesperson ?>
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
