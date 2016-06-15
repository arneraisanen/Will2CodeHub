<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
<title>Home Page</title>
</head>
<body style="background-color: #EEEEEE;">
<div>

	<table style="width: 90%; margin: 30px auto 200px;">
		<tr style="text-align: center;">
			<td><h1>Arbco Master Admin Tool</h1></td>
		</tr>
		<tr style="text-align: center;">
			<td><img style="width: 100px;" alt="Arbco Estimator" src="/images/arbco_logo.png" /></td>
		</tr>
		<tr style="text-align: center;">
			<td>Coaching & Training<br />Licensed Software</td>
		</tr>
		<tr style="text-align: center;">
			<td style="padding: 0px;"><div style="position: relative; top: 40px; text-align: -webkit-center; width: 100%;">
					<form action="process/generic_sign_in.php" method="post" enctype="multipart/form-data" class="form-signin" style="width: 300px; margin: 30px auto 150px;">
			        <label for="inputEmail" class="sr-only">Email address</label>
			        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
			        <label for="inputPassword" class="sr-only">Password</label>
			        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
			        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			      </form>
				</div></td>
		</tr>
		<tr style="text-align: center;">
			<td style="padding-top: 100px;"><img style="width: 100%;" alt="Arbco Estimator" src="/images/estimator_main_image.png" /></td>
		</tr>
	</table>
	
	<div class="options-home">
		<div class="container">
		</div>
		<img style="width:100%;" src="/images/footer_image.svg" /><br /><br />	
		<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>
	</div>
</div>
</body>
</html>