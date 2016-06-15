<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

ob_start();
include($doc_root."/business_logic/user_admin/get_cities_states.php");
$insert_states = ob_get_contents();
ob_end_clean();

$panel = <<<EOD
<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="logo">
						<a href="$website_root"> <img
							src="$website_root/images/logo-img.png">
						</a>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="login-menu">
						<ul>
							<li>$insert_states</li>
							<li><a href="$website_root/business_logic/about.php">About</a></li>
							<li><a href="$website_root/business_logic/contact.php">Contact</a></li>
							<li><a href="$website_root/business_logic/user_admin/">Register</a></li>
							<li><a href="$website_root/business_logic/sign_in.php">Sign In</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
EOD;

echo $panel;
?>



