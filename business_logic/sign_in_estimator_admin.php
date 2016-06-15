<?php 
include "../global_paths.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Sign into the Admin Backend</title>
  </head>

  <body>

    <div class="container marketing" style="clear:both;">
		<div class="requirment-techers-you" style="color:#fff;">
			<p>
				<div style="margin: 10px 0px 0px 40px;"></div><a href="http://www.arbco.org"><img alt="Arbco Estimator" src="/images/arbco_logo.png" /></a><div style="">Licensed Software</div></div>
			</p>
			<div style="color:#fff;margin: 100px 0px 40px 0px;">
			</div>
		</div>
     
      <form action="process/admin_sign_in.php" method="post" enctype="multipart/form-data" class="form-signin" style="width: 300px; margin: 30px auto 150px;">
        <h2 class="form-signin-heading">Admin Tool: sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>


        <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->

  </body>
</html>