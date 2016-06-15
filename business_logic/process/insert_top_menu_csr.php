<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
if ($_SESSION['role'] == 'admin')
	$login_str = '<li><a href="' . $website_root . '/business_logic/admin/">Admin Home</a></li>
				  <li><a href="' . $website_root . '/business_logic/admin/signout.php">Sign Out</a></li>';
else 
	$login_str = '<li><a href="' . $website_root . '/business_logic/admin/csr_scripts/project_scripts_home.php">Home</a></li>
			<li><a href="' . $website_root . '/business_logic/admin/signout.php">Sign Out</a></li>';
	
$panel = <<<EOD
<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="logo">
						
					</div>
				</div>
				<div class="col-sm-7">
					<div class="login-menu">
						<ul>
							$login_str
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
EOD;

echo $panel;
?>



