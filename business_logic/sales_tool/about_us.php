<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
<title>Madina Beauty Lounge - The Sweet Beauty Experience</title>
<script>
			
	function initialize() {
	  var mapOptions = {
	    center: new google.maps.LatLng(51.503454,-0.119562),
	    zoom: 8,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	  
	  var markers = [
	        ['London Eye, London', 51.503454,-0.119562],
	        ['Palace of Westminster, London', 51.499633,-0.124755]
	  ];
	  
	  // markers & place each one on the map  
	  for( i = 0; i < markers.length; i++ ) {
	    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
	    bounds.extend(position);
	    marker = new google.maps.Marker({
	      position: position,
	      map: map,
	      title: markers[i][0]
	    });
	    // Automatically center the map fitting all markers on the screen
	    map.fitBounds(bounds);
	  }
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<body>
<div id="wrapperDiv">
	
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
	
	<!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide" style="height:600px;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('http://madinabeautylounge.de/images/Intraceuticals Hollywood Secret.jpg');"></div>
                <div class="carousel-caption">
                    <h2 style="opacity:1;">Intraceuticals/Anti-Aging</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('http://madinabeautylounge.de/images/hydrafacial.jpg');"></div>
                <div class="carousel-caption">
                    <h2 style="opacity:1;">Person/Story</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('http://madinabeautylounge.de/images/intraceuticals.jpg');"></div>
                <div class="carousel-caption">
                    <h2 style="opacity:1;">Facials vrs.Products</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('http://madinabeautylounge.de/images/Shellac.jpg');"></div>
                <div class="carousel-caption">
                    <h2 style="opacity:1;">Ambiente</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('http://madinabeautylounge.de/images/slide4.jpg');"></div>
                <div class="carousel-caption">
                    <h2 style="opacity:1;">Wedding/Events</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    
    <section id="holder">
		    	
		<div class="row" style=" background-color: #fff; padding:20px;">
			<div class="col-sm-4">
				<img src="/images/featured_product.jpg" title="" alt="" />
			</div>
			<div class="col-sm-4">
				<img src="/images/featured_product.jpg" title="" alt="" />
    		</div>
			<div class="col-sm-4">
				<img src="/images/featured_product.jpg" title="" alt="" />
    		</div>
    	</div>
		
		<div class="row" style="margin-top: 50px; height: 500px; background-image: url(/images/model1.jpg) !important; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
			<div class="col-sm-12">
				<div class="fp_title_1"><h1 style="text-transform: uppercase;">We want you to look amazing</h1></div>
				<div class="fp_title_2"><h2 style="text-transform: uppercase;font-family: serif; font-size: 2em;">Look and feel 20 years younger</h2></div>
				<div class="fp_title_3">To get a feel for what it means to regenerate your youthfulness, book a consultation appointment today and let us discuss what works best for your personal needs</div>
				<a href="#"><div class="fp_title_4">Book Appointment</div></a>
	    	</div>
		</div>
		
		<div class="row">
    		<div class="col-sm-6">
				<div class="row" style="margin-left:0px;padding-left:0px;">
					<div class="col-sm-6" style="margin-left:0px;padding-left:0px;">	
						<div class="opening-time" style="margin: 30px 30px 10px 0px; padding: 10px 20px 40px 20px; border: 1px solid #a2a196; color: #a2a196;">
							<h4 class="footer-widget-title">OPENING TIMES</h4><dl><dt>Monday</dt><dd>08:00 - 17:30</dd></dl><dl><dt>Tuesday</dt><dd>08:00 - 17:30</dd></dl><dl><dt>Wednesday</dt><dd>08:00 - 17:30</dd></dl><dl><dt>Thursday</dt><dd>08:00 - 17:30</dd></dl><dl><dt>Friday</dt><dd>08:00 - 17:30</dd></dl><dl><dt>Saturday</dt><dd>12:00 - 17:30</dd></dl><dl><dt>Sunday</dt><dd>CLOSED</dd></dl></div>
			    	</div>
			    		
					<div class="col-sm-6" style="margin-left:0px;padding-left:0px;">	
						<div style="color: #a2a196; font-size:1.2em; margin: 30px 30px;">
							<address>
			            		<h2 style="color: #a2a196; font-size:1.2em; margin: 0px 0px;">Madina Beauty Lounge Address</h2><br>
			           			Neuturmstraﬂe 2, 80331<br>
			            		Munich<br>
			            		Bavaria<br>
			            		Germany<br>
			            		<abbr title="Work Mobile">Mobile:</abbr> +49(0) 176 262 333 44
			          			</address>
			    		</div>
			    	</div>
			    </div>
			    
			    <div class="row" style="margin-left:0px;padding-left:0px;">
					<div class="col-sm-11" style="color: #a2a196; font-size:1.2em; margin: 30px 30px 30px 0px; padding-left:0px;">
						  <h2 style="color: #fff; font-size: 1.2em; margin-top: 0px; background-color: #a2a196; padding: 5px;">Contact Us</h2><br>
		      
					      <form class="form-horizontal">
					          <div class="form-group">
					              <div class="col-xs-6">
					                  <input class="form-control" id="firstName" name="firstName" placeholder="First Name" required="" type="text">
					              </div>
					              <div class="col-xs-6">
					                  <input class="form-control" id="lastName" name="lastName" placeholder="Last Name" required="" type="text">
					              </div>
					          </div>
					          <div class="form-group">
					              <div class="col-xs-7">
					                  <input class="form-control" name="email" placeholder="Email" required="" type="email">
					              </div>
					              <div class="col-xs-5">
					                  <input class="form-control" name="phone" placeholder="Phone" required="" type="phone">
					              </div>
					          </div>
					          <div class="form-group">
					              <div class="col-xs-12">
					                <button class="btn btn-primary pull-right">Submit</button>
					              </div>
					          </div>	
					      </form>
		    		</div>
			    </div>
			</div>
			<div class="col-sm-6">
				<div style="width: 100%;text-align: right; padding-right: 10px;">
			    	<iframe style="margin:30px 0px;" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d665.6484936662503!2d11.5810149!3d48.137353!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1459514314242" width="600" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
			    </div>
			</div>
    	</div>

	</section>
		
</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>
</body>
</html>