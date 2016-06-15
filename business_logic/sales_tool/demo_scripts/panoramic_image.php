<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
<title>Your Teachers - Home Page 2</title>
<script src='http://code.jquery.com/jquery-1.9.1.min.js' type='text/javascript'></script>
<style>
      #image-reel{ font-size: 85%; margin: auto; }
      #image-reel .reel-annotation { color: #6a7587; white-space: nowrap; font-weight: bold; font-size: 108%; color: #6a7587; cursor: help; }
      #image-reel a.reel-annotation { color: white; }
      #image-reel .far.reel-annotation { font-size: 85%; color: white; }
      #image-reel a.far.reel-annotation { color: white; }
      #image-reel .near.reel-annotation { font-size: 163%; color: #fff5de; }
      #image-reel a.near.reel-annotation { color: #fff5de; }
      #image-reel .title.reel-annotation { font-size: 85%; color: white; }
      #image-reel a.title.reel-annotation { color: white; }
      #image-reel .headline.reel-annotation { font-size: 280%; opacity: 0.5; color: white; cursor: inherit; }
      #image-reel a.headline.reel-annotation { color: white; }
    </style>
</head>
<body>
<div id="wrapperDiv">
	
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>
	
	<div class="requirment-techers">
		<div class="container">
			<div class="requirment-techers-you">
				<p>
					Hotspot Demo: <span>Clickable Panoramic Image</span>
				</p>
			</div>
		</div>
	</div>
	<div class="options-home">
		<div class="container">
		<div class="row">
				<div class="jumbotron" id="project_scripts_display_box">
				  	<img src="images/sea_scene_thumb.jpg" width="800" height="469"
				      class="reel"
				      id="image"
				      data-image="images/sea_scene.jpg"
				      data-orientable="true"
				      data-stitched="2000"
				      vertical="true">
				
				    <span class="reel-annotation headline"
				      id="headline"
				      data-x="60"
				      data-y="380"
				      data-for="image">
				      Panoramic Image Demo
				    </span>
				
				    <a class="reel-annotation title"
				      id="title"
				      href="http://demos.themunicheye.com"
				      data-x="60"
				      data-y="420"
				      data-for="image">
				      Demo page for Wismy
				    </a>
				
				    <a class="reel-annotation"
				      id="panther_peak"
				      href="http://www.mapquest.com/maps?name=Panther%20Peak&city=Sequoia%20National%20Park&state=CA"
				      data-x="450"
				      data-y="230"
				      data-for="image">
				      Clear blue water
				    </a>
				
				    <span class="reel-annotation far"
				      id="castle_rocks"
				      data-x="1150"
				      data-y="210"
				      data-for="image">
				      Small Title
				    </span>
				    <span class="reel-annotation far"
				      id="dropdownliast"
				      data-x="1350"
				      data-y="210"
				      data-for="image">
				      <select style="color:#000000">
				      	<option value="">Choose Something</option>
				      	<option value="1">Place something here</option>
				      	<option value="2">And something else here</option>
				      </select>
				    </span>
				
				    <a class="reel-annotation near"
				      id="moro_rock"
				      href="http://demos.themunicheye.com"
				      data-x="900"
				      data-y="200"
				      data-for="image">
				      Large Title
				    </a>
				
				    <a class="reel-annotation"
				      id="milk_ranch_peak"
				      href="https://en.wikipedia.org/wiki/Fish"
				      data-x="970"
				      data-y="30"
				      data-for="image">
				      Nice Fish
				    </a>
				</div>
		</div>
			
			<div class="row">
						</div>
						</div>
						<div class="vacancies-main">
						<div class="vac-tbg">
						<div class="container">
						<div class="row">
						<div class="col-sm-4">
						<div class="vacancies">
						<h1>Vacancies</h1>
						<div class="vacancies-box">100+</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="vacancies">
						<h1>Teachers</h1>
						<div class="vacancies-box">5000+</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="vacancies">
						<h1>schools</h1>
						<div class="vacancies-box">200+</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						
						<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_testimonial_panel.php"; ?>

						<script type="text/javascript">
							var LHCChatOptions = {};
							LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
							(function() {
							var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
							var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
							po.src = 'http://demos.themunicheye.com/live_helpdesk/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							})();
						</script>
		
		<footer>
		<div class="footer-top-main">
		<div class="container">
		<div class="row">
				<div class="col-sm-6">
				<h1>Contact</h1>
				<form action="" id="contactForm">
				<div class="footer-form">
				<div class="row">
				<div class="col-sm-6">
				<input type="text" name="senderName" placeholder="Name"
												class="form-control tf"> <input type="text"
												name="senderEmail" placeholder="E-mail"
												class="form-control tf"> <input type="text"
												name="senderMobile" placeholder="Mobile"
												class="form-control tf">
														</div>
														<div class="col-sm-6">
														<textarea rows="4" name="senderMessage" placeholder="Message"
												class="form-control text-area"></textarea>
												<a id="sendMail" href="" class="send-btn">Send</a>
												</div>
												</div>
												</div>
												</form>
												</div>
												<div class="col-sm-6">
												<div class="email-call">
												<ul>
												<li class="email-icon">
												<h2>E-mail us:</h2>
												<p>
												<a href="mailto:teachersconsultant@gmail.com">Teachersconsultant@gmail.com</a>
												</p>
												</li>
												<li class="phone-icon">
												<h2>Call:</h2>
												<p>
												<a href="tel:8220899699">8220899699</a> <a
												href="tel:9500506468">9500506468</a>
												</p>
												</li>
												</ul>
												</div>
												</div>
												</div>
												</div>
												</div>
												<div class="footer-bottom-main">
												<div class="container">
												
												</div>
												</div>
												</footer>
		<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>
		
		<script src="../../process/jquery_reel.js"></script>

		
</div>
</body>
</html>