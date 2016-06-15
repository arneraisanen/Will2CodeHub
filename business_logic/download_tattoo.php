<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Tattoo Download</title>
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>

    <div class="container marketing" style="clear:both;">

     
      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider" style="margin: 10px 0 0px 0;">

      <div class="row featurette">
        <div class="col-md-12">
        <br /><br />
          <p class="lead">Tattoo: <?php echo $_GET["link"]; ?> - (click image to download)</p>
          <p></p><br />
          <div class="table-responsive">
            <a href="../image_repository/<?php echo $_GET["link"] ?>" download><img src="../image_repository/<?php echo $_GET["link"] ?>" /></a>
          </div>
        </div>
      </div>

      <hr class="featurette-divider">

      

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


         <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->

	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>
  </body>
</html>