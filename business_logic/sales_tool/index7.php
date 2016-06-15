<?php
include_once "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
session_start();

include($doc_root."/business_logic/sales_tool/get_level_plan_info.php");

ob_start();
include($doc_root."/business_logic/sales_tool/create_platinum_proposal_text.php");
$proposal_platinum_text= ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_gold_proposal_text.php");
$proposal_gold_text = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_basic_proposal_text.php");
$proposal_basic_text = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_platinum_proposal_pdf.php");
$proposal_platinum = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_platinum_proposal_no_cost_pdf.php");
$proposal_platinum_no_cost = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_gold_proposal_pdf.php");
$proposal_gold = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_gold_proposal_no_cost_pdf.php");
$proposal_gold_no_cost = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_basic_proposal_pdf.php");
$proposal_basic = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/create_basic_proposal_no_cost_pdf.php");
$proposal_basic_no_cost = ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/sales_tool/get_salesperson_incrememnt_pdf.php");
$proposal_id_number = ob_get_contents();
ob_end_clean();

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in_estimator_sales.php';

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "sales" )
	{
		header($sign_in);
		exit;
	}
}
else
{
	require_once '../admin/db/db_manager.php';
	$username = $_POST["email"];
	$password = $_POST["password"];
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT id, username, password, role, firstname, surname, last_login, company_id FROM users WHERE username='$username' AND password='$password'");
		$STH->execute();
	
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	if ($STH->rowCount() > 0) 
	{
		while($row = $STH->fetch())
		{
			if ($row["username"] == $username)
			{
				$_SESSION['logged_in'] = $row["username"];
				$_SESSION['role'] = $row["role"];
				$_SESSION['id'] = $row["id"];
				$_SESSION['company_id'] = $row["company_id"];
				$_SESSION['fullname'] = $row["firstname"] . ' ' . $row["surname"];
				$_SESSION['last_login'] = $row["last_login"];
				$datetime_var = date("Y-m-d H:i:s");
				$company_logo = './';
				
				try
				{
					$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
					$STH2 = $DBH2->prepare("UPDATE users SET last_login = :last_login WHERE id = :id");
				
					$STH2->execute(array(
							':id' => $_SESSION['id'],
							':last_login' => $datetime_var
					));
				}
				catch(PDOException $e)
				{
					echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
					file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
					exit;
				}
				
				try
				{
					$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
					$STH2 = $DBH2->prepare("SELECT logo FROM company WHERE id='$company_id'");
					$STH2->execute();
				
					$STH2->setFetchMode(PDO::FETCH_ASSOC);
				}
				catch(PDOException $e)
				{
					echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
					file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
					exit;
				}
				
				while($row2 = $STH2->fetch())
				{
					$company_logo = $row2["logo"];
					$_SESSION['company_logo'] = $company_logo;
				}
			}
			else
			{
				header($sign_in);
			}
		}
	}
	else
		header($sign_in);
}
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/sales_tool/insert_admin_header.php"; ?>
    <title>Sales Dashboard: <?php echo $_SESSION['logged_in']; ?></title>
    <link rel="stylesheet" href="sales_pages/main.css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  	<script src="sales_pages/main.js"></script>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/sales_tool/insert_admin_menu.php"; ?>
        
        <div class="col-sm-12 main">
          <h2 style="float:left;" class="sub-header">Welcome <?php echo $fullname . '</h2> <div style="float:right;">(last login: ' . $_SESSION['last_login'] . ')'; ?></div><br/>
          <div style="float:left; margin-top: 10px; position:absolute;">
         		<img id="info_button" style="cursor: pointer;float: left;clear: both; margin-top: 50px;" src="/images/info.png" title="Click to Toggle Page Instructions" alt="Click to Toggle Page Instructions" /><br /><div id="info_div" style="display:none;z-index: 1000;width: 400px;margin: 10px 10px 60px;float: right;clear: both;border-radius: 10px;padding: 15px;color: #ddd;background-color: #5c9112;">The Arbco Estimator Software Tool provides users with the ability to automatically create and send bespoke client-specific work proposals/estimates. Click the various buttons below to send these proposals to the client in question.</div>
         	</div>
          <div style="float:right; margin-top: 10px;"><img style="width:150px;height:100%;margin-top: 20px;" src="<?php echo $_SESSION['company_logo'] ?>" /></div>

          	<section>
				<br /><br />
			</section>
		
		<section id="holder">
		    <h1 style="color:#404040;clear: both;" class="begining">Proposal</h1>
		    
		    <div class="container">	
				<form id="theform">
					<div class="row">
						<div class="col-sm-6">
													
							<div class="email-form" id="add_field" style="min-width: 800px;">
								<div style="width:100%;">
									PDF proposals are located in the relevant tab below.  You can use the back buttons to edit the content of this proposal at any time.  All proposals are saved and viewable at a later date.
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			
			 <ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home"><?php echo $best ?> Quote</a></li>
			  <li><a data-toggle="tab" href="#menu1"><?php echo $better ?> Quote</a></li>
			  <li><a data-toggle="tab" href="#menu2"><?php echo $good ?> Quote</a></li>
			</ul>
			
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			    <div class="container">	
					<form id="theform">
						<div class="row">
							<div class="col-sm-6" style="width:100%;">
														
								<div class="email-form" id="add_field" style="min-width: 800px;">
									<div style="width: 900px; height: 800px;">
										<!-- <object id="iFramePdf" width="100%" height="100%" data="<?php echo $proposal_platinum ?>"></object> -->
										<pre style="font-family:inherit;height: 100%;"><?php echo $proposal_platinum_text ?></pre>
									</div>
									<label style="float: right;">
									<div class="cancel-submit" style="margin-top: 30px; padding:0px; float:right; font-size:10px;">
										<ul>
											<li style="width:150px;">
												<button id="registerBtn41" type="button" onclick="print_proposal(event, 1,1,'<?php echo $proposal_platinum ?>');">Print with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn42" type="button" onclick="print_proposal(event, 1,2,'<?php echo $proposal_platinum_no_cost ?>');">Print with no price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn43" type="button" onclick="print_proposal(event, 1,3,'<?php echo $proposal_platinum ?>');">Email with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn44" type="button" onclick="print_proposal(event, 1,4,'<?php echo $proposal_platinum_no_cost ?>');">Email with no price</button>
											</li>
											<li style="width:150px;">
												<button style="text-decoration: inherit; padding: inherit; margin: inherit;" id="registerBtn5" type="button" onclick="print_proposal(1,5,'<?php echo $proposal_platinum ?>');"><a href="<?php echo $proposal_platinum ?>" download>Save PDF to desktop</a></button>
											</li>
										</ul>
									</div>
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <div class="container">	
					<form id="theform">
						<div class="row">
							<div class="col-sm-6" style="width:100%;">
														
								<div class="email-form" id="add_field" style="min-width: 800px;">
									<div style="width: 900px; height: 800px;">
										<!-- <embed src="<?php echo $proposal_gold ?>" width="100%" height="100%" type='application/pdf'> -->
										<pre style="font-family:inherit;height: 100%;"><?php echo $proposal_gold_text ?></pre>
									</div>
									<label style="float: right;">
									<div class="cancel-submit" style="margin-top: 30px; padding:0px; float:right; font-size:10px;">
										<ul>
											<li style="width:150px;">
												<button id="registerBtn6" type="button" onclick="print_proposal(event, 2,1,'<?php echo $proposal_gold ?>');">Print with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn7" type="button" onclick="print_proposal(event, 2,2,'<?php echo $proposal_gold_no_cost ?>');">Print with no price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn8" type="button" onclick="print_proposal(event, 2,3,'<?php echo $proposal_gold ?>');">Email with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn9" type="button" onclick="print_proposal(event, 2,4,'<?php echo $proposal_gold_no_cost ?>');">Email with no price</button>
											</li>
											<li style="width:150px;">
												<button style="text-decoration: inherit; padding: inherit; margin: inherit;" id="registerBtn19" type="button" onclick="print_proposal(2,5,'<?php echo $proposal_gold ?>');"><a href="<?php echo $proposal_platinum ?>" download>Save PDF to desktop</a></button>
											</li>
										</ul>
									</div>
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			  </div>
			  <div id="menu2" class="tab-pane fade">
			    <div class="container">	
					<form id="theform">
						<div class="row">
							<div class="col-sm-6" style="width:100%;">
														
								<div class="email-form" id="add_field" style="min-width: 800px;">
									<div style="width: 900px; height: 800px;">
										<!-- <embed src="<?php echo $proposal_basic ?>" width="100%" height="100%" type='application/pdf'> -->
										<pre style="font-family:inherit;height: 100%;"><?php echo $proposal_basic_text ?></pre>
									</div>
									<label style="float: right;">
									<div class="cancel-submit" style="margin-top: 30px; padding:0px; float:right; font-size:10px;">
										<ul>
											<li style="width:150px;">
												<button id="registerBtn11" type="button" onclick="print_proposal(event, 3,1,'<?php echo $proposal_basic ?>');">Print with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn12" type="button" onclick="print_proposal(event, 3,2,'<?php echo $proposal_basic_no_cost ?>');">Print with no price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn13" type="button" onclick="print_proposal(event, 3,3,'<?php echo $proposal_basic ?>');">Email with price</button>
											</li>
											<li style="width:150px;">
												<button id="registerBtn14" type="button" onclick="print_proposal(event, 3,4,'<?php echo $proposal_basic_no_cost ?>');">Email with no price</button>
											</li>
											<li style="width:150px;">
												<button style="text-decoration: inherit; padding: inherit; margin: inherit;" id="registerBtn15" type="button" onclick="print_proposal(3,5,'<?php echo $proposal_basic ?>');"><a href="<?php echo $proposal_platinum ?>" download>Save PDF to desktop</a></button>
											</li>
										</ul>
									</div>
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			  </div>
			</div>
		    
		    <p><a class="link" href="index6.php" data-color="#fff"><button style="width:150px;" type="button" class="btn btn-primary">Previous</button></a></p>
		    <br /><br />
		    <p>Or choose a page to edit: </p>
			<form id="theform2" style="width: 610px;margin: auto;">
			    <button style="" id="registerBtn15" type="button"><a href="index2.php">Client Details</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index3.php">Client Job Info</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index4.php">Materials</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index5.php">Sub Contractors</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index6.php">Permits/Sales Tax</a></button>
			</form> 
		</section>
		
        </div>
      </div>
      
	<img style="width:100%;" src="/images/footer_image.svg" />
    </div>

<script src="<?php echo $website_root ?>/js/bootstrap.min.js"></script>
  </body>
</html>
