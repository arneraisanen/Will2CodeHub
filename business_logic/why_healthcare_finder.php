<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Why Medlist Nigeria</title>
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>

    <div class="container marketing" style="clear:both;">

    <?php $id=5; include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_wordpress_article.php"; ?>

    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->
    
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>

    
  </body>
</html>