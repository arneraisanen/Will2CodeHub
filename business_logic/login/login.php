<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Your Teachers - Login</title>

<!-- Bootstrap -->
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-select.css">
<link href="../../css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
						
<!-- JQuery -->
<script type="text/javascript" src="../../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../js/spin.min.js"></script>
<script type="text/javascript" src="../../js/yt_home.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="logo">
						<a href="/yourteacherqa/appHome.do"> <img
							src="../../images/logo-img.png">
						</a>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="login-menu">
						<ul>
							<li>
								<form class="form-inline">
									<div class="form-group location-select">
										<select id="lunch" class="selectpicker" title="Location">
											<option>Location</option>
											<option>Location 1</option>
											<option>Location 2</option>
											<option>Location 3</option>
											<option>Location 4</option>
											<option>Location5</option>
										</select>
									</div>
								</form>
							</li>
							<li><a href="/yourteacherqa/appLoginHome.do">Login</a></li>
							<li><a href="/business_logic/registration/sign_up.php">Sign Up</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<form id="fbForm" action="/yourteacherqa/signin/facebook" method="POST">
		 <input type="hidden" name="scope" value="email" />
	</form>
	<form id="loginForm" action="/yourteacherqa/signIn.do" method="POST">
		<div class="container">
		
			<div class="login-socail-site-submitt">
		
				<div class="login-socail-site">
					<ul>
						<li class="bord"><a id="fbLogin" href="" class="facebook"><img
								src="../../images/fb-img.png" /></a></li>
						<li class="log-or"><a href="#" class="or">Or</a></li>
						<li class="bord"><a href="#" class="Google"><img
								src="../../images/google.png"></a></li>
					</ul>
				</div>
				<div class="form-information">
					<input id="userEmail" name="userEmail" class="mobile" placeholder="Email" required="required" type="email" value=""/>
					<input id="password" name="password" class="mobile" placeholder="Password" required="required" type="password" value=""/>
					<div class="login-forgot">

					<div class="btn-group" data-toggle="buttons">
						<label class="btn check-b"> <input type="checkbox"
							autocomplete="off"> Remember me
						</label>
					</div>


			
						<ul>

							<li><a href="" class="active" id="loginBtn"> Login</a></li>
							<li><a href="/yourteacherqa/showPwdRecoveryPage.do">Forgot Password?</a></li>

						</ul>
					</div>

				</div>
				<div class="fot-sign-up">
					<p>
						Don't have an account?<a href="/yourteacherqa/showSignupOptions.do">Sign up now!!!</a>
						</p>
						</div>
						</div>
						</div>
						<input type="submit"  id="submitBtn" value="submit" style="visibility: hidden;" />
						</form>

						<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- 	included in begining so commented  -->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/yourteacherqa/static/js/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="/yourteacherqa/static/js/bootstrap-select.js"></script>
</body>
</html>