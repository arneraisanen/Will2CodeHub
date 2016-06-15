<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Tattoo Search Results</title>
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
          <p class="lead">The following results were found for: <?php echo $_POST["search_keywords"]; ?></p>
          <p></p><br />
          <h2 class="sub-header">Results</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Download Link</th>
                </tr>
              </thead>
              <tbody> 
              	<?php include "doctors_admin/get_tattoo_images.php"; ?>
              </tbody>
            </table>
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