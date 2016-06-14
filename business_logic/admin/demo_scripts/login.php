<?php
session_start();

if (isset($_POST["submit"])) 
{
	$login_fail = '';
	
	include "includes/config.php";
	$website_root = 'http://'. $_SERVER['SERVER_NAME'];
	$sign_in = 'Location: ' . $website_root . '/admin/home.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	try
	{
		$host = "localhost";
		$dbname = "drinkfre_juic";
		$user = "drinkfre_juic";
		$pass = "juic12345";
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT admin_username, admin_password FROM zummo_tbladmin WHERE admin_username='$username' AND admin_password='$password'");
		$STH->execute();
	
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Details: " . $e->getMessage();
		exit;
	}
	
	if ($STH->rowCount() > 0)
	{
		$_SESSION['username'] = $username;
		header($sign_in);
		exit;
	}
	else
		$login_fail = "Login Failed: please try again";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="lJ9fo87an9eRszyTt_bHSeWhUagY4y2_wLSvJfHoY0w" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zummo Orange Citrus Juicers  Parts Service Automatic Commercial Juciers </title>
<meta name="keywords" content="" />
<meta name="description" content="Zummo Juicing Equipment Co. (1-856-599-ZUMMO) offers Zummo automatic citrus juicers in the United States, as well as other European and American made automatic and manual fruit and vegetable juicers, hydraulic presses, blenders, cooling units and slushy machines. " />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<script type="text/javascript" src="browerd.js"></script>
<script type="text/javascript">
if(BrowserDetect.browser == 'Safari' && BrowserDetect.OS == 'iPhone/iPod') {
	document.write("<style>.bottom_content{ margin:0; padding:15px 0; background:url(/images/bottom_bg.jpg) repeat-x #f1a501; height:283px;}</style>");
}
</script>
<!-- JavaScript codes -->
<script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="/js/jquery.fullscreenr.js" type="text/javascript"></script>
<script type="text/javascript">  
		<!--
			// You need to specify the size of your background image here (could be done automatically by some PHP code)
			var FullscreenrOptions = {  width: 1900, height: 1400, bgID: '#bgimg' };
			// This will activate the full screen background!
			jQuery.fn.fullscreenr(FullscreenrOptions);
		//-->
</script>
<script type="text/javascript" src="/js/search.js"></script>
<script type="text/javascript" src="/js/pagination.js"></script>
<script> htmlData('/search.php', '); </script>

</head>

<body style="overflow:hidden;">
<img src="/images/image1.jpg" id="bgimg" alt="" />
<div class="container">
    <meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=1200" />

<div class="header">
    <div class="header_container"> <a href="http://www.juicingequipment.com/" class="logo">ZUMMO</a>
        <ul class="top-nav">
          <li><a href="http://www.juicingequipment.com/">Home</a></li>
          <li><a href="http://www.juicingequipment.com/about_us">About Us</a></li>
          <li><a href="http://www.juicingequipment.com/contact">Contact Us</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<div style="width: 300px; margin: 50px auto;background-color: #fff; padding: 40px;">
	<form class="form-horizontal" method="post"  action="login.php">
		<div style="color:#000;font-weight:bold; font-size:18px;">LOGIN</div>
		<div style="color:#000;"><?php echo $login_fail ?></div>
        	<div class="form-group">
            	<span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
	            <div class="col-md-8 req">
	            	<input style="margin: 20px;" value="username" id="fname" name="username" type="text" placeholder="Vorname" class="form-control">
	            </div>
        	</div>
	        <div class="form-group">
	        	<span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i>
	        </span>
	        <div class="col-md-8 req">
	       		<input style="margin: 0px 20px 20px 20px;" value="password" id="lname" name="password" type="text" placeholder="Nachname" class="form-control">
	        </div>

            <div class="form-group">
            	<div class="col-md-12 text-center">
            		<button style="margin: 10px;" type="submit" name="submit" class="btn btn-primary btn-lg">Login</button>
            	</div>
            </div>
        </div>
	</form>
</div>


 <div>
          
	<div class="bottom_content">

    <div class="bottom_container">

      <div class="latest_news">

        <h2>Latest News</h2>

        <ul>


          <li>

           

            <p><b><a href="http://www.juicingequipment.com/blog/the-smart-vending-machine" style="color:#000000">The Smart Vending Machine</a></b></p>

            <p><p>Imagine getting a late night text from your vending machine asking you to come refill it. Now, if that doesn’t get you motivated to get out of bed and make more money we don’t know what will! Zummo ZV25 orange &hellip; <a href="http://www.juicingequipment.com/blog/the-smart-vending-machine">Continue reading <span class="meta-nav">&rarr;</span></a></p>
</p>

            
          </li>


          <li>

           

            <p><b><a href="http://www.juicingequipment.com/blog/check-our-booth-at-the-biggest-trade-show-in-the-industry-nra-2015" style="color:#000000">Check Our Booth At The Biggest Trade Show In The Industry &#8211; NRA 2015!</a></b></p>

            <p><p>Thank you all so much for attending our largest booth ever at the NRA show. We exhibited a wide range of juicing and small kitchen equipment &#8211; FS cold presses, Zummo automatic citrus juicer, Nutrifaster vegetable juicers, Sencotel juice chillers &hellip; <a href="http://www.juicingequipment.com/blog/check-our-booth-at-the-biggest-trade-show-in-the-industry-nra-2015">Continue reading <span class="meta-nav">&rarr;</span></a></p>
</p>

            
          </li>

         



		        </ul>

        <div class="clear"></div>

      </div>

	  

	  

      <div class="service_list">

        <h2>Services</h2>

        <ul>

			<li>Lease-to own / rent </li>

			<li>Buy / trade-in </li>

			<li>Parts</li>

			<li>Repair / Troubleshoot</li>

			<li>Routine maintenance</li>

			<li>Business concept development</li>

			<li>Custom advertising, bottles, cups</li>

        </ul>

        <div class="clear"></div>

      </div>

	

      <div class="conatact">

        <h2>Stay With Us</h2>
<p>Zummo Juicing Equipment Company</p>
<p>1-856-59-ZUMMO</p>
<p>Calling from Canada? (416)900-5582<br>
  <a href="mailto:"sales@juicingequipment.com">sales@juicingequipment.com</a></p>


        <h2>Follow Us</h2>

        <ul class="social">

          <li><a href="http://www.youtube.com/user/ZUMMOjuicers" class="yt" target="_blank">YouTube</a></li>

          <li><a href="http://www.facebook.com/ZummoEquipment" class="fb" target="_blank">Facebook</a></li>

        </ul>

        <div class="clear"></div>

      </div>

      <div class="clear"></div>

    </div>

    <div class="clear"></div>

  </div>

  <div class="footer">

    <div class="footer-container">

      <div class="flt_lft">ZUMMO &copy; 2012 <a href="http://www.juicingequipment.com/privacy_policy">Privacy Policy</a> | <a href="http://www.juicingequipment.com/sitemap">Site Map</a></div>

      <div class="flt_rht"><img src="/images/card.jpg" alt="" /></div>

    </div>

    <div class="clear"></div>

  </div>	</div>
</body>
</html>
