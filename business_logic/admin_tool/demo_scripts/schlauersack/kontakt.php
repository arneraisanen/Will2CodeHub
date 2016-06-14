<?php
if (isset($_POST["submit"])) 
{
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$from = 'SchlauerSack Contact Form';
	$to = 'info@schlauersack.ch';
	$subject = 'Contact Form Enquiry for SchlauerSack';
	
	$errMessage = '';
	$errEmail = '';
	$errSurname = '';
	$errFirstName = '';
	$result = '';
	
	$body ="From: $firstname $surname\n E-Mail: $email\n Phone: $phone\n Message:\n $message";

	// Check if name has been entered
	if (!$_POST['firstname']) {
		$errFirstName = 'Bitte tätigen Sie eine Auswahl';
	}
	if (!$_POST['surname']) {
		$errSurname = 'Bitte tätigen Sie eine Auswahl';
	}
	
	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Bitte geben Sie eine gültige e-Mail Adresse ein';
	}
		
	//Check if message has been entered
	if (!$_POST['message']) {
		$errMessage = 'Bitte tätigen Sie eine Auswahl';
	}

	// If there are no errors, send the email
	if (!$errFirstName &&!$errSurname && !$errEmail && !$errMessage) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Vielen Dank für Ihre kontakt!</div>';
			$firstname = '';
			$surname = '';
			$email = '';
			$phone = '';
			$message = '';
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
		}
	}
}
else {
	$firstname = '';
	$surname = '';
	$email = '';
	$phone = '';
	$message = '';
	$from = '';
	$to = '';
	$subject = '';
	
	$errMessage = '';
	$errEmail = '';
	$errSurname = '';
	$errFirstName = '';
	$result = '';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Schlauersack</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img src="images/logo.png" /></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav nav-justified">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">Über den schlauen Sack</a></li>
                <li><a href="abo_ubersicht.php">Abo Übersicht</a></li>
                <li><a href="bestell_formular.php">Abo bestellen</a></li>
                <li><a href="einzugsgebiet.php">Einzugsgebiet/Abholtag</a></li>
                <li class="active"><a href="kontakt.php">Kontakt</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>

    <div class="row featurette" style="margin-top: 200px;padding: 20px;">
        <div class="col-md-12">
          <div class="table-responsive">
				<div class="container">
				    <div class="row">
				        <div class="col-md-12">
				            <div class="well well-sm">
				                <form class="form-horizontal" method="post"  action="kontakt.php">
				                    <fieldset>
				                        <legend class="text-center header">kontaktieren Sie uns</legend>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $firstname;?>" id="fname" name="firstname" type="text" placeholder="Vorname" class="form-control">
				                                <?php echo "<p class='text-danger'>$errFirstName</p>";?>
				                            </div>
				                        </div>
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $surname;?>" id="lname" name="surname" type="text" placeholder="Nachname" class="form-control">
				                                <?php echo "<p class='text-danger'>$errSurname</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $email;?>" id="email" name="email" type="text" placeholder="E-Mail Adresse" class="form-control">
				                                <?php echo "<p class='text-danger'>$errEmail</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
				                            <div class="col-md-8">
				                                <input id="phone" name="phone" type="text" placeholder="Telefon" class="form-control">
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <textarea class="form-control" id="message" name="message" placeholder="Hier können Sie Ihre Nachricht an uns erfassen. Wir melden uns so schnell wie möglich bei Ihnen." rows="7"><?php echo $message;?></textarea>
				                                <?php echo "<p class='text-danger'>$errMessage</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <div class="col-md-12 text-center">
				                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Senden</button>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <div class="col-md-12 text-center">
				                                <?php echo $result; ?>
				                            </div>
				                        </div>
				                    </fieldset>
				                </form>
				            </div>
				        </div>
				    </div>
				</div>

<style>
    .header {
        color: #36A0FF;
        font-size: 27px;
        padding: 10px;
    }

    .bigicon {
        font-size: 35px;
        color: #36A0FF;
    }
</style>
            </p>
          </div>
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
      
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p style="width:900px; margin:auto; font-size: x-large; color: #4EC2E4;">www.schlauersack.ch - info@schlauersack.ch - 079 954 66 21 - 079 954 66 59</p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
