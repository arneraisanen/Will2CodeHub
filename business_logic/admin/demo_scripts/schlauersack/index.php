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
		$errFirstName = 'Please enter your first name';
	}
	if (!$_POST['surname']) {
		$errSurname = 'Please enter your surname';
	}
	
	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}
		
	//Check if message has been entered
	if (!$_POST['message']) {
		$errMessage = 'Please enter your message';
	}

	// If there are no errors, send the email
	if (!$errFirstName &&!$errSurname && !$errEmail && !$errMessage) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! SchlauerSack will be in touch</div>';
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">Über den schlauen Sack</a></li>
                <li><a href="abo_ubersicht.php">Abo Übersicht</a></li>
                <li><a href="bestell_formular.php">Abo bestellen</a></li>
                <li><a href="einzugsgebiet.php">Einzugsgebiet/Abholtag</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row" style="margin-top: 200px;padding: 20px;background-color:#eee;);">
        <div class="col-lg-4">
          <img class="img-circle" src="images/formular icon.png" alt="Generic placeholder image" width="200" height="200">
          <h2>1. Anmelden</h2>
          <p>Melden Sie sich noch heute an und gönnen Sie sich ein Recycling Service. Die Anmeldung geht schnell und unkompliziert!</p>
          <p><a class="btn btn-default" href="bestell_formular.php" role="button">Bestellen &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="images/bg icon updated.png" alt="Generic placeholder image" width="200" height="200">
          <h2>2. Sammeln</h2>
          <p>Ab sofort sammeln Sie alle Recycling-Güter nur noch in EINEM schlauen Sack, den Sie wöchentlich von uns zur Verfügung gestellt kriegen.</p>
          <p><a class="btn btn-default" href="abo_ubersicht.php" role="button">Details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="images/auto.png" alt="Generic placeholder image" width="200" height="200">
          <h2>3. Wir holen den schlauen Sack ab!</h2>
          <p>Wir holen 1x wöchentlich den schlauen Sack direkt vor Ihrer Haustür ab! 
Einfacher geht's nicht!</p>
          <p><a class="btn btn-default" href="einzugsgebiet.php" role="button">Einzugsgebiet und Abholtag &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Wieso schlauer Sack?<br /><span style="font-size: x-large;" class="text-muted">Weil Sie etwas Gutes für die Umwelt tun und gleichzeitig wertvolle Zeit sparen!</span></h2>
          <p class="lead">Vorbei mit mühsamen Trennen von Recycling Material und Haufen von PET, Glas, Alu, Papier und Karton im Keller oder in der Garage.
Gönnen Sie sich den Luxus und bestellen Sie noch heute ein Abo vom schlauen Sack! Werfen Sie all den Recyling-Abfall in den einen
schlauen Sack und wir erledigen den Rest - Woche für Woche - korrekt und umweltfreundlich.

<br /><br />NEU: Das Recycling-Taxi aus der Region.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/table_main.png" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Recycling<br /><span style="font-size: x-large;" class="text-muted"> - schlau - bequem - korrekt - umweltfreundlich</span></h2>
          <p class="lead"><br /><br />
          <ul style="font-size:21px; font-weight:300;">
			<li style="list-style:disc;">schlau:                    Sie sparen viel Zeit</li>
			<li style="list-style:disc;">bequem:                 Sie können den Recycling Abfall direkt vor der Haustüre abholen lassen</li>
			<li style="list-style:disc;">korrekt:                   Wir arbeiten mit spezialisierten Firmen zusammen, die dem alten Recycling-Gut neues Leben schenkt.</li>
			<li style="list-style:disc;">umweltfreundlich:   Wir fahren für alle Haushalte - nicht jeder Haushalt fährt mit seinem Auto seine eigenen Runden.</li>
		  </ul></p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="images/recycle.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Mehr Freizeit für wenig Geld <span style="font-size: x-large;" class="text-muted"></span></h2>
          <p class="lead">Nehmen wir mal an, Sie investieren rund einen halben Tag Arbeit pro Monat in das korrekte recyclen von verschiedenen Materialien.
		  <ul style="font-size:21px; font-weight:300;">
			<li style="list-style:disc;">Trennen</li>
			<li style="list-style:disc;">Aufbewahren</li>
			<li style="list-style:disc;">Aufbereiten (wie bündeln von Papier etc.)</li>
			<li style="list-style:disc;">Ins Auto einladen und zur Sammelstelle bringen</li>
			<li style="list-style:disc;">Vielleicht müssen Sie sogar mehrere Sammelstellen anfahren (Karton etc.)</li>
			<br />Jetzt haben Sie die Möglichkeit diese Arbeiten für weniger als 20 Franken im Monat auszulagern.
			Oder würden Sie für 20 Franken einen halben Tag arbeiten gehen?
			Wenn nicht – ist das schlaue Sack Abo genau das Richtige für Sie!<br /><br />
			Gönnen Sie sich den Luxus.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/clock.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>

	  <div class="footer-top-main" style="background-color: #eee;margin-bottom: 60px;padding: 30px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 style="color: #BADA55;font-weight: 500;">Kontakt</h1>
					<form action="" id="contactForm">
					<div class="footer-form">
						<div class="row">
							<div class="col-sm-6">
								<input type="text" name="senderName" placeholder="Name"
									class="form-control tf"> <input type="text"
									name="senderEmail" placeholder="Email"
									class="form-control tf"> <input type="text"
									name="senderMobile" placeholder="Telefon"
									class="form-control tf">
								</div>
								<div class="col-sm-6">
									<textarea rows="4" name="senderMessage" placeholder="Nachricht"
									class="form-control text-area"></textarea>
									<a id="sendMail" href="" class="send-btn">Senden</a>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<div class="email-call">
						<ul>
							<li class="email-icon">
								<h2 style="color: #BADA55;">Schreiben Sie uns:</h2>
								<p>
									<a href="mailto:teachersconsultant@gmail.com">info@schlauersack.ch</a>
								</p>
							</li>
							<li class="phone-icon">
								<h2 style="color: #BADA55;">Telefon :</h2>
								<p>
									<a href="tel:0799546621">079 954 66 21</a><br /><a href="tel:0799546659">079 954 66 59</a>
								</p>
							</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
      
        <p style="width:900px; margin:auto; font-size: x-large; color: #4EC2E4;">www.schlauersack.ch - info@schlauersack.ch - 079 954 66 21 - 079 954 66 59</p>
        <br />
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p><a href="agb.php">AGB</a></p>
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
