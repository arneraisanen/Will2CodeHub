<?php
include_once "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

session_start();

$company_id = $_SESSION["company_id"];

try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH2 = $DBH2->prepare("SELECT `expiry_date` FROM `company_account` WHERE company_id=:company_id");
	$STH2->bindParam(':company_id', $company_id);
	$STH2->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$expiry_date = '';
$no_days_left = '';
while($row2 = $STH2->fetch())
{
	$expiry_date = $row2["expiry_date"];
	$now = time();
	$your_date = strtotime($expiry_date);
	$datediff = $your_date - $now;
	$no_days_left = floor($datediff/(60*60*24));
}

if ($no_days_left != '')
	$license_expiry_str = 'Your license expires in <strong style="">' . $no_days_left . ' days</strong> on the ' . date('m-d-Y', strtotime($expiry_date));
else 
	$license_expiry_str = 'You are currently using an unlimitied trial license';

$one_month = '';
$three_month = '';
$six_month = '';
$twelve_month = '';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `one_month`, `three_month`, `six_month`, `twelve_month` FROM `license_prices` WHERE id='1'");
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$one_month = $row["one_month"];
	$three_month = $row["three_month"];
	$six_month = $row["six_month"];
	$twelve_month = $row["twelve_month"];
}

$data1=array(
		'merchant_email'=>'arne@arbco.us',
		'product_name'=>'Estimator License (1 month)',
		'amount'=>$one_month,
		'currency_code'=>'USD',
		'thanks_page'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/',
		'notify_url'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/checkout/ipn.php',
		'cancel_url'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
		'paypal_mode'=>false,
);

$data2=array(
		'merchant_email'=>'arne@arbco.us',
		'product_name'=>'Estimator License (3 months)',
		'amount'=>$three_month,
		'currency_code'=>'USD',
		'thanks_page'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/',
		'notify_url'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/checkout/ipn.php',
		'cancel_url'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
		'paypal_mode'=>false,
);

$data3=array(
		'merchant_email'=>'arne@arbco.us',
		'product_name'=>'Estimator License (6 months)',
		'amount'=>$six_month,
		'currency_code'=>'USD',
		'thanks_page'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/',
		'notify_url'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/checkout/ipn.php',
		'cancel_url'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
		'paypal_mode'=>false,
);

$data4=array(
		'merchant_email'=>'arne@arbco.us',
		'product_name'=>'Estimator License (12 months)',
		'amount'=>$twelve_month,
		'currency_code'=>'USD',
		'thanks_page'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/',
		'notify_url'=>"http://".$_SERVER['HTTP_HOST'].'/business_logic/admin_tool/checkout/ipn.php',
		'cancel_url'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
		'paypal_mode'=>false,
);

if(isset($_POST['pay_now1']))
{
	echo infotutsPaypal($data1);
}else if(isset($_POST['pay_now2']))
{
	echo infotutsPaypal($data2);
}else if(isset($_POST['pay_now3']))
{
	echo infotutsPaypal($data3);
}else if(isset($_POST['pay_now4']))
{
	echo infotutsPaypal($data4);
}

function infotutsPaypal( $data) 
{
	include_once "../../global_paths.php";
	require $_SERVER['DOCUMENT_ROOT'].'/business_logic/admin/db/db_manager.php';
	define( 'SSL_URL', 'https://www.paypal.com/cgi-bin/webscr' );
	define( 'SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr' );
	
	$company_id = $_SESSION['company_id'];
	$rand_num = rand(100, 999);
	$reference_number = 'arbco' . $rand_num . 'est' . $company_id;
	$amount = $data['amount'];
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("INSERT INTO `payments` (`reference_number`, `amount`, `company_id`) VALUES ( :reference_number, :amount, :company_id )");
	
		$STH->bindParam(':reference_number', $reference_number);
		$STH->bindParam(':amount', $amount);
		$STH->bindParam(':company_id', $company_id);
		$STH->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	$action = '';
 	//Is this a test transaction?
 	$action = ($data['paypal_mode']) ? SSL_SAND_URL : SSL_URL;

	$form = '';

	$form .= '<form name="frm_payment_method" action="' . $action . '" method="post">';
	$form .= '<input type="hidden" name="business" value="' . $data['merchant_email'] . '" />';
	// Instant Payment Notification & Return Page Details /
	$form .= '<input type="hidden" name="notify_url" value="' . $data['notify_url'] . '" />';
	$form .= '<input type="hidden" name="cancel_return" value="' . $data['cancel_url'] . '" />';
	$form .= '<input type="hidden" name="return" value="' . $data['thanks_page'] . '" />';
	$form .= '<input type="hidden" name="rm" value="2" />';
	// Configures Basic Checkout Fields -->
	$form .= '<input type="hidden" name="lc" value="" />';
	$form .= '<input type="hidden" name="no_shipping" value="1" />';
	$form .= '<input type="hidden" name="no_note" value="1" />';
	// <input type="hidden" name="custom" value="localhost" />-->
	$form .= '<input type="hidden" name="currency_code" value="' . $data['currency_code'] . '" />';
	$form .= '<input type="hidden" name="page_style" value="paypal" />';
	$form .= '<input type="hidden" name="charset" value="utf-8" />';
	$form .= '<input type="hidden" name="invoice" value="' . $reference_number . '" />';
	$form .= '<input type="hidden" name="item_name" value="' . $data['product_name'] . '" />';
	$form .= '<input type="hidden" value="_xclick" name="cmd"/>';
	$form .= '<input type="hidden" name="amount" value="' . $data['amount'] . '" />';
	$form .= '<script>';
	$form .= 'setTimeout("document.frm_payment_method.submit()", 1);';
	$form .= '</script>';
	$form .= '</form>';
	return $form;
}

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in_estimator_admin.php';

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "admin" )
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
	
		$STH = $DBH->prepare("SELECT id, username, password, role, firstname, surname, last_login FROM users WHERE username='$username' AND password='$password'");
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
				$_SESSION['fullname'] = $row["firstname"] . ' ' . $row["surname"];
				$_SESSION['last_login'] = $row["last_login"];
				$datetime_var = date("Y-m-d H:i:s");
				
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
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_header.php"; ?>
    <title>Admin Dashboard: <?php echo $_SESSION['logged_in']; ?></title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 style="float:left;" class="sub-header">Welcome  <?php echo $fullname ?></h2><br/>
          <div style="float:right; margin-top: 10px;"><?php echo $fullname . ' (last login: ' . $_SESSION['last_login'] . ')'; ?></div>

          <section>
			<br /><br />
			<ul class="tabs">
				<li class="active">Account Status</li>
				<li>Packages</li>
			</ul>

			<div class="tabs">
				
				<div class="js">
					<p><div style="text-align: center;margin: 10px 40px 50px;background-color: #F5F5F5;padding: 20px;font-size: 1.3em;"><?php echo $license_expiry_str; ?></div></p>
					<p></p>
					<p>Please choose package below and click "Pay Now" to be redirected to the external Paypal payments page</p>
					<p><italics>Note: packages are appended to the end of the next expiry date</italics></p>
					<br /><br />
					<select id="license_type_id" onchange="choose_license_type();">
						<option value="">Please Choose A Package</option>
						<option value="1">1 month</option>
						<option value="3">3 months</option>
						<option value="6">6 months</option>
						<option value="12">12 months</option>
					</select>
					<div class="radio">
						<label class="radio-inline"><input onchange="save_recurring_var();" type="radio" name="optradio" id="optradio1" checked>Recurring</label>
					</div>
					<div class="radio">
					  	<label class="radio-inline"><input onchange="save_recurring_var();" type="radio" name="optradio" id="optradio2">Non-recurring</label>
					</div><br /><br />

					<form style="display:none;background-color: #eee;padding: 30px;border: 1px solid #ccc;border-radius: 10px;" id='paypal-info1' method='post' action='#'>
						<label>Product Name : <?php echo $data1['product_name']; ?></label></br></br>
						<label style="margin-right: 30px;">Product Price : <?php echo $data1['amount'].' '.$data1['currency_code']; ?></label>
						
						<input type='submit' name='pay_now1' id='pay_now1' value='Pay Now' />
					</form>
					
					<form style="display:none;background-color: #eee;padding: 30px;border: 1px solid #ccc;border-radius: 10px;" id='paypal-info2' method='post' action='#'>
						<label>NOTE: CLICKING "Pay Now" WILL TAKE YOU TO PAYPAL.COM TO COMPLETE THE PAYMENT PROCESS</label></br></br>
						<label>Product Name : <?php echo $data2['product_name']; ?></label></br></br>
						<label style="margin-right: 30px;">Product Price : <?php echo $data2['amount'].' '.$data2['currency_code']; ?></label>
						
						<input type='submit' name='pay_now2' id='pay_now2' value='Pay Now' />
					</form>
					
					<form style="display:none;background-color: #eee;padding: 30px;border: 1px solid #ccc;border-radius: 10px;" id='paypal-info3' method='post' action='#'>
						<label>NOTE: CLICKING "Pay Now" WILL TAKE YOU TO PAYPAL.COM TO COMPLETE THE PAYMENT PROCESS</label></br></br>
						<label>Product Name : <?php echo $data3['product_name']; ?></label></br></br>
						<label style="margin-right: 30px;">Product Price : <?php echo $data3['amount'].' '.$data3['currency_code']; ?></label>
						
						<input type='submit' name='pay_now3' id='pay_now3' value='Pay Now' />
					</form>
					
					<form style="display:none;background-color: #eee;padding: 30px;border: 1px solid #ccc;border-radius: 10px;" id='paypal-info4' method='post' action='#'>
						<label>NOTE: CLICKING "Pay Now" WILL TAKE YOU TO PAYPAL.COM TO COMPLETE THE PAYMENT PROCESS</label></br></br>
						<label>Product Name : <?php echo $data4['product_name']; ?></label></br></br>
						<label style="margin-right: 30px;">Product Price : <?php echo $data4['amount'].' '.$data4['currency_code']; ?></label>
						
						<input type='submit' name='pay_now4' id='pay_now4' value='Pay Now' />
					</form>
					<br /><br />
				</div>

				<div class="css">
					<!-- Button trigger modal 
					<button class="btn btn-primary btn-lg" data-toggle="modal" 
					   data-target="#profile_image_edit_1">
					   Edit profile image
					</button>-->
					1 Month: <?php echo $one_month ?><br /><br />
					3 Months: <?php echo $three_month ?><br /><br />
					6 Months: <?php echo $six_month ?><br /><br />
					12 Months: <?php echo $twelve_month ?><br /><br />
				</div>
			</div>
		</section>
		
					
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
		   aria-labelledby="myModalLabel" aria-hidden="true">
		   <div class="modal-dialog">
		      <div class="modal-content">
		         <div class="modal-header">
		            <button type="button" class="close" 
		               data-dismiss="modal" aria-hidden="true">
		                  &times;
		            </button>
		            <h4 class="modal-title" id="myModalLabel">
		               This Modal title
		            </h4>
		         </div>
		         <div class="modal-body">
		            Add some text here
		         </div>
		         <div class="modal-footer">
		            <button type="button" class="btn btn-default" 
		               data-dismiss="modal">Close
		            </button>
		            <button type="button" class="btn btn-primary">
		               Submit changes
		            </button>
		         </div>
		      </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="profile_image_edit_1" tabindex="-1" role="dialog" 
		   aria-labelledby="myModalLabel" aria-hidden="true">
		   <div class="modal-dialog" style="width: 750px;">
		      <div class="modal-content">
		         
		         <div class="modal-body">
		            <iframe src="jcrop/index.php?id=<?php echo $_SESSION['id']; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="890px"></iframe>
		         </div>
		      </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- Modal -->
		<div class="modal fade" id="profile_edit_1" tabindex="-1" role="dialog" 
		   aria-labelledby="myModalLabel" aria-hidden="true">
		   <div class="modal-dialog" style="width: 750px;">
		      <div class="modal-content">
		         
		         <div class="modal-body">
		            <iframe src="show_professional_profile.php?action=0&id=1" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="900px"></iframe>
		         </div>
		      </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
        </div>
      </div>
    </div>


<script src="<?php echo $website_root ?>/js/bootstrap.min.js"></script>
  </body>
</html>
