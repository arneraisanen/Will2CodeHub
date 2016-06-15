<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

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
							<li><a href="$website_root/business_logic/about.php">About</a></li>
							<li><a href="$website_root/business_logic/contact.php">Contact</a></li>
							<li><a href="$website_root/business_logic/admin/signout.php">Sign Out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
EOD;

echo $panel;
?>



