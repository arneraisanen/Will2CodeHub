<?php 
include_once "global_paths.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
<title>Home Page</title>
</head>
<body style="background-color: #EEEEEE;">
<div>
	<table style="width: 90%; margin: 30px auto 0px;">
		<tr style="text-align: center;">
			<td><h1>ARBCO ESTIMATOR SOFTWARE</h1></td>
		</tr>
		<tr style="text-align: center;">
			<td><img style="width: 100px;" alt="Arbco Estimator" src="/images/arbco_logo.png" /></td>
		</tr>
		<tr style="text-align: center;">
			<td>Coaching & Training<br />Licensed Software</td>
		</tr>
		<tr style="text-align: center;">
			<td>Version 2.0</td>
		</tr>
		<tr style="text-align: center;">
			<td style="padding: 0px;"><div style="position: relative; top: 40px; text-align: -webkit-center; width: 100%;">
					<div style="color:#fff; margin-bottom:20px;"><a style="background-color: #004200; padding: 10px; border-radius: 10px; color: #fff;" href="business_logic/sign_in_estimator_admin.php">Estimator Admin Login</a></div> 
					<div style="color:#fff;"><a style="background-color: #004200; padding: 10px; border-radius: 10px; color: #fff;" href="business_logic/sign_in_estimator_sales.php">&nbspEstimator Sales Login&nbsp</a></div>
				</div></td>
		</tr>
		<tr style="text-align: center;">
			<td style="padding-top: 100px;"><img style="width: 50%;" alt="Arbco Estimator" src="/images/estimator_main_image.png" /></td>
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