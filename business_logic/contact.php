<?php
if (isset($_POST["submit"])) 
{
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$human = intval($_POST['human']);
	$from = 'Your Teachers Contact Form';
	$to = 'wfsmyth@gmail.com';
	$subject = 'Contact Form Enquiry for Your Teachers';
	
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
	if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! Your teachers will be in touch</div>';
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Contact Your Teachers</title>
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>

    <div class="container marketing" style="clear:both;">
     <div class="form-group">
                            <div class="col-md-12 text-center">
                                <?php echo $result; ?>
                            </div>
                        </div>
                        
      

    <?php $id=8; include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_wordpress_article.php"; ?>
      
      <div class="row featurette">
        <div class="col-md-12">
          <div class="table-responsive">
				<div class="container">
				    <div class="row">
				        <div class="col-md-12">
				            <div class="well well-sm">
				                <form class="form-horizontal" method="post"  action="contact.php">
				                    <fieldset>
				                        <legend class="text-center header">Contact us</legend>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $firstname;?>" id="fname" name="firstname" type="text" placeholder="First Name" class="form-control">
				                                <?php echo "<p class='text-danger'>$errFirstName</p>";?>
				                            </div>
				                        </div>
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $surname;?>" id="lname" name="surname" type="text" placeholder="Last Name" class="form-control">
				                                <?php echo "<p class='text-danger'>$errSurname</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <input value="<?php echo $email;?>" id="email" name="email" type="text" placeholder="Email Address" class="form-control">
				                                <?php echo "<p class='text-danger'>$errEmail</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
				                            <div class="col-md-8">
				                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
				                            <div class="col-md-8 req">
				                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"><?php echo $message;?></textarea>
				                                <?php echo "<p class='text-danger'>$errMessage</p>";?>
				                            </div>
				                        </div>
				
				                        <div class="form-group">
				                            <div class="col-md-12 text-center">
				                                <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
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

      

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


          <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->

	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>
  </body>
</html>