<?php
$id = $_GET["id"]; 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ship Shop Color Picker</title>
		<meta name="description" content="A simple, light-weight plugin that makes it easy for your customers to see your products in different colors" />
		<meta name="keywords" content="color visualizer, color chooser, jquery, plugin, javascript, product visualizer, product customizer" />
		<meta name="Classification" content="Computers: Programming: Languages: JavaScript: Scripts" />
		<meta name="ROBOTS" content="index, follow" />
		<meta name="Revisit-after" content="20 days" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="js/jquery.productColorizer.css" />
		<link href="http://fonts.googleapis.com/css?family=Asap:400,700" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script type="text/javascript" src="js/raphael-min.js"></script>
		<script type="text/javascript" src="js/jquery.productColorizer.js"></script>
		<script type="text/javascript" src="js/prettify.js"></script>
		<script type="text/javascript" src="js/init.js"></script>

    	<link rel="stylesheet" href="css/tinycarousel.css" type="text/css" media="screen"/>

    	
    	<script src="js/jquery.tinycarousel.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#slider1").tinycarousel({
			        bullets  : true
			    });
			});
		</script>
    	
	</head>
	<body>
		
		<div id="demo" class="container clearfix">
			
			<h2>Customise Your Yacht</h2>
			<p>Choose colours for the exterior paintwork and sails</p>
					
			<div class="product-preview">
	
				<div id="slider1">
					<a class="buttons prev" href="#">&#60;</a>
					<div class="viewport">
						<ul class="overview">
							<?php 
								$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
								$number_of_files = iterator_count($fi);

								for ($i=1; $i<=$number_of_files/2; $i++)
								{
									echo '
									<li>
										<div class="product">
											<img class="ship_styles" src="images/' . $id . '/' . $i . '.jpg" alt="Mask Image" />
											<img id="tt-mask-' . $i . '" class="mask" src="images/' . $id . '/' . $i . '_mask.png" alt="Mask Image ' . $i . '" />
										</div>
									</li>';
								}
							?>
						</ul>
					</div>
					<a class="buttons next" href="#">&#62;</a>
				</div>
		
				<div class="color-chooser-box">
				<h3>Blue Coast 101' Double Deck sailing catamaran</h3>
				<p>Exterior Color</p>
				<h4>Choose a Base Color:</h4>
					<div class="swatch">
						<a rel="255,255,255" href="#tt-mask" title="White">White</a>
						<a rel="32,223,95" href="#tt-mask" title="Green">Green</a>
						<a rel="255,211,8" href="#tt-mask" title="Yellow">Yellow</a>
						<a rel="255,101,8" href="#tt-mask" title="Orange">Orange</a>
						<a rel="16,200,255" href="#tt-mask" title="Blue">Blue</a>
						<a rel="142,8,255" href="#tt-mask" title="Purple">Purple</a>
						<a rel="245,25,45" href="#tt-mask" title="Red">Red</a>
					</div>
				<h4>Choose a Premium Color:</h4>
					<div class="swatch">
						<a rel="16,200,255" href="#tt-mask" title="Blue">Blue</a>
						<a rel="142,8,255" href="#tt-mask" title="Purple">Purple</a>
						<a rel="245,25,45" href="#tt-mask" title="Red">Red</a>
					</div>
				<h4>Choose a Sail Color:</h4>
					<div class="swatch">
						<a rel="255,255,255" href="#logo-mask" title="White">White</a>
						<a rel="32,223,95" href="#logo-mask" title="Green">Green<</a>
						<a rel="142,8,255" href="#logo-mask" title="Purple">Purple</a>
						<a rel="245,25,45" href="#logo-mask" title="Red">Red</a>
					</div>
				</div>
			</div>
		</div><!-- /demo -->
	</body>
</html>