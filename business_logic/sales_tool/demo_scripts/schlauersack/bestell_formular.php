<?php
if (isset($_POST["submit"])) 
{
	$agb = $_POST['agb'];
	$plz_ort = $_POST['plz_ort'];
	$strasse = $_POST['strasse'];
	$telefonnummer = $_POST['telefonnummer'];
	$email = $_POST['email'];
	$unternehmen = $_POST['unternehmen'];
	$surname = $_POST['surname'];
	$firstName = $_POST['firstName'];
	$email = $_POST['email'];
	$optradio0 = $_POST['optradio0'];
	$optradio1 = $_POST['optradio1'];
	$optradio2 = $_POST['optradio2'];
	
	$from = 'SchlauerSack Contact Form';
	$to = 'info@schlauersack.ch';
	$subject = 'Contact Form Enquiry for SchlauerSack';
	
	$errPlz_ort = '';
	$errTelefonnummer = '';
	$errUnternehmen = '';
	$errAgb = '';
	$errStrasse = '';
	$errOptradio0 = '';
	$errOptradio1 = '';
	$errOptradio2 = '';
	$errEmail = '';
	$errSurname = '';
	$errFirstName = '';
	$result = '';
	
	$body ="Bestellen Formular:\n\n
	Name: $firstName $surname\n
	Email: $email\n
	Telefonnummer: $telefonnummer\n
	PLZ/Ort: $plz_ort\n
	Strasse: $strasse\n
	Unternehmen: $unternehmen\n
	Abo wählen: $optradio0\n
	Zahlungsweise: $optradio1\n
	Zubehör: $optradio2\n
	AGB - Ya\n
	End of message";

	// Check if name has been entered
	if (!$_POST['firstName'] || $_POST['firstName'] == 'Vorname') {
		$errFirstName = 'Bitte tätigen Sie eine Auswahl';
	}
	if (!$_POST['surname'] || $_POST['surname'] == 'Name') {
		$errSurname = 'Bitte tätigen Sie eine Auswahl';
	}
	
	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Bitte geben Sie eine gültige e-Mail Adresse ein';
	}
	
	if (!$_POST['telefonnummer'] || $_POST['telefonnummer'] == 'Telefonnummer') {
		$errTelefonnummer = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['plz_ort']) {
		$errPlz_ort = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['strasse'] || $_POST['strasse'] == 'Strasse und Hausnummer') {
		$errStrasse = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['optradio0']) {
		$errOptradio0 = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['optradio1']) {
		$errOptradio1 = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['optradio2']) {
		$errOptradio2 = 'Bitte tätigen Sie eine Auswahl';
	}
	
	if (!$_POST['agb']) {
		$errAgb = 'Bitte tätigen Sie eine Auswahl';
	}

	// If there are no errors, send the email
	if ( (!$errFirstName && $errFirstName != 'Vorname') && (!$errSurname && $errSurname != 'Name') && (!$errEmail && $errEmail != 'E-Mail Adresse') && !$errAgb && (!$errTelefonnummer && $errTelefonnummer != 'Telefonnummer') && !$errPlz_ort && (!$errStrasse && $errStrasse != 'Strasse und Hausnummer') && !$errOptradio0 && !$errOptradio1 && !$errOptradio2) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Vielen Dank für Ihre Bestellung! Sie erhalten in kürze das schlauer Sack starterpaket</div>';
			$firstName = 'Vorname';
			$surname = 'Name';
			$email = 'E-Mail Adresse';
			$telefonnummer = 'Telefonnummer';
			$unternehmen = 'Name des Unternehmens (optional)';
			$agb = '';
			$plz_ort = '';
			$strasse = 'Strasse und Hausnummer';
			$optradio0 = '';
			$optradio1 = '';
			$optradio2 = '';
			
			$from = '';
			$to = '';
			$subject = '';
			
			$errPlz_ort = '';
			$errTelefonnummer = '';
			$errUnternehmen = '';
			$errAgb = '';
			$errStrasse = '';
			$errOptradio0 = '';
			$errOptradio1 = '';
			$errOptradio2 = '';
			$errEmail = '';
			$errSurname = '';
			$errFirstName = '';
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
		}
	}
}
else {
	$firstName = 'Vorname';
	$surname = 'Name';
	$email = 'E-Mail Adresse';
	$telefonnummer = 'Telefonnummer';
	$unternehmen = 'Name des Unternehmens (optional)';
	$agb = '';
	$plz_ort = '';
	$strasse = 'Strasse und Hausnummer';
	$optradio0 = '';
	$optradio1 = '';
	$optradio2 = '';
	
	$from = '';
	$to = '';
	$subject = '';
	
	$errPlz_ort = '';
	$errTelefonnummer = '';
	$errUnternehmen = '';
	$errAgb = '';
	$errStrasse = '';
	$errOptradio0 = '';
	$errOptradio1 = '';
	$errOptradio2 = '';
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

    <title>SchlauerSack</title>

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
                <li class="active"><a href="bestell_formular.php">Abo bestellen</a></li>
                <li><a href="einzugsgebiet.php">Einzugsgebiet/Abholtag</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>

   <div class="container" style="margin-top: 200px;padding: 20px;margin-bottom: 60px;width:800px;border-radius: 40px;border: solid 1px #4CC1E4;background-color: #F0F0F0;">
		<form id="teacherRegForm" action="bestell_formular.php" method="post">
			<div class="registration-teach" style="font-size: 14px;">
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <?php echo $result; ?>
                            </div>
                        </div>
				<h2 style="color: #4EC2E4;">Bestellformular Recycling Service</h2>
				<p style="padding: 20px 40px 60px 20px;text-align:center;font-size: 16px;">Sie sammeln Glas, PET, ALU, Batterien etc. in unserem schlauen Sack. Wir holen den Sack 1x pro Woche bei Ihnen zu Hause ab.</p>
				<div class="registration-form">
						<div class="row">
							<div class="col-sm-12">
								<div class="req">
									<label style="margin-top: 10px;">Abo wählen</label>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Hause S">Für zu Hause "S" (Glas, Pet, Alu & Batterien) / Jahresabo / CHF 14.90 pro Monat</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Hause M">Für zu Hause "M" (Glas, Pet, Alu, Batterien und Papier) / Jahresabo / CHF 17.90 pro Monat</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Hause L">Für zu Hause "L" (Glas, Pet, Alu, Batterien, Papier, Karton und PE-Material) / Jahresabo / CHF 19.90 pro Monat</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Büro S">Für das Büro "S" (Glas, Pet, Alu & Batterien) / Jahresabo / CHF 17.90 pro Monat</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Büro M">Für das Büro "M" (Glas, Pet, Alu, Batterien und Papier) / Jahresabo / CHF 19.90 pro Monat</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio0" value="Für zu Büro L">Für das Büro "L" (Glas, Pet, Alu, Batterien, Papier, Karton und PE-Material) / Jahresabo / CHF 22.90 pro Monat</label>
									</div>
									<?php echo "<p class='text-danger'>$errOptradio0</p>";?>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12">
								<div class="req">
									<label style="margin-top: 10px;">Zahlungsweise</label>
									<div class="radio">
									  <label><input type="radio" name="optradio1" value="jährlich">jährlich (Rechnung)</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio1" value="quartalsweise">quartalsweise (Rechnung)</label>
									</div>
									<?php echo "<p class='text-danger'>$errOptradio1</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="req">
									<label style="margin-top: 10px;">Zubehör</label>
									<div class="radio">
									  <label><input type="radio" name="optradio2" value="nein Danke">Ich brauche kein Behälter für den schlauen Sack (CHF 0.00)</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio2" value="351">35l Eimer wetterfest für den schlauen Sack (+ CHF 35.-- einmalig)</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="optradio2" value="1101">110l Faltbox für den schlauen Sack (+ CHF 35.-- einmalig)</label>
									</div>
									<?php echo "<p class='text-danger'>$errOptradio2</p>";?>
								</div>
							</div>
						</div>
						<br /><br />
						
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<input id="firstName" name="firstName" class="school-name" required="required" data-trigger="focus" type="text" value="<?php echo $firstName;?>"/>
									<?php echo "<p class='text-danger'>$errFirstName</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<input id="lastName" name="surname" class="school-name" required="required" type="text" value="<?php echo $surname;?>"/>
									<?php echo "<p class='text-danger'>$errSurname</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="">
									<input id="unternehmen" name="unternehmen" class="school-name" required="required" type="text" value="<?php echo $unternehmen;?>"/>
									<?php echo "<p class='text-danger'>$errUnternehmen</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<input id="email" name="email" class="school-name" required="required" type="email" value="<?php echo $email; ?>"/>
									<?php echo "<p class='text-danger'>$errEmail</p>";?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<input id="mobileNumber" name="telefonnummer" class="school-name" required="required" type="text" value="<?php echo $telefonnummer; ?>"/>
									<?php echo "<p class='text-danger'>$errTelefonnummer</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<input id="addressLine1" name="strasse" class="school-name" required="required" type="text" value="<?php echo $strasse; ?>"/>
									<?php echo "<p class='text-danger'>$errStrasse</p>";?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-8">
								<div class="req">
									<select name="plz_ort" id="plz_ort" class="form-control" title="plz_ort">
										<option value="">PLZ/Ort</option>
										<option value="4313 Möhllin">4313 Möhllin</option>
										<option value="4322 Mumpf">4322 Mumpf</option>
										<option value="4323 Wallbach">4323 Wallbach</option>
										<option value="4324 Obermumpf">4324 Obermumpf</option>
										<option value="4325 Schupfart">4325 Schupfart</option>
										<option value="4332 Stein">4332 Stein</option>
										<option value="4333 Münchwilen">4333 Münchwilen</option>
										<option value="4334 Sisseln">4334 Sisseln</option>
										<option value="5070 Frick">5070 Frick</option>
										<option value="5074 Eiken">5074 Eiken</option>
									</select>
									<?php echo "<p class='text-danger'>$errPlz_ort</p>";?>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-sm-8">
								<div class="">
									<button type="submit" name="submit">Bestellen</button>
								</div>
							</div>
						</div>
					<div class="Mandatory">
						<p> *<span> Pflichtfeld</span></p>
					</div><br />
					<input name="agb" id="agb" type="checkbox" autocomplete="off">
					<label class="">Bitte akzeptieren Sie die <a href="agb.php" target="_blank">AGB</a>
					<?php echo "<p class='text-danger'>$errAgb</p>";?>	
					</label>
				</div>
			</div>
			</form>
		</div>


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
