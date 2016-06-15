<?php
include_once "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
session_start();

ob_start();
include($doc_root."/business_logic/sales_tool/get_client.php");
$client_form = ob_get_contents();
ob_end_clean();

include($doc_root."/business_logic/sales_tool/get_client_dates.php");

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="sales_pages/main.js"></script>
  	
  	<script>
$(document).ready(
		function() {
			// Create a jqxDateTimeInput
			$("#field_9_add").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_11_add").jqxDateTimeInput({width: '100%', height: '34px'});
			$("#field_9_add").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$("#field_11_add").jqxDateTimeInput({ formatString: 'MM-dd-yyyy' });
			$('#jqxDateTimeInput').val(new Date());

			var date_formatted_str = '<?php echo $client_date_formatted ?>';
			var result_array = date_formatted_str.split("-");
			var result_array_month = result_array[0] - 1;
			var date = new Date();
            date.setFullYear(result_array[2], result_array_month, result_array[1]);
            $('#field_9_add').jqxDateTimeInput('setDate', date);

            var date_formatted_str = '<?php echo $install_date_formatted ?>';
			var result_array = date_formatted_str.split("-");
			var result_array_month = result_array[0] - 1;
			var date = new Date();
            date.setFullYear(result_array[2], result_array_month, result_array[1]);
            $('#field_11_add').jqxDateTimeInput('setDate', date);
		});
</script>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/sales_tool/insert_admin_menu.php"; ?>
        
        <div class="col-sm-12 main">
          <h2 style="float:left;" class="sub-header">Welcome <?php echo $fullname . '</h2> <div style="float:right;">(last login: ' . $_SESSION['last_login'] . ')'; ?></div><br/>
          <div style="float:left; margin-top: 10px; position:absolute;">
         	  <img id="info_button" style="cursor: pointer;float: left;clear: both; margin-top: 50px;" src="/images/info.png" title="Click to Toggle Page Instructions" alt="Click to Toggle Page Instructions" /><br /><div id="info_div" style="display:none;z-index: 1000;width: 400px;margin: 10px 10px 60px;float: right;clear: both;border-radius: 10px;padding: 15px;color: #ddd;background-color: #5c9112;">Here you can create a new client (by filling out the blank input fields), or start a new proposal based on an old client template (by selecting the client template from the field "Existing Client").<br /><br /><strong>Note:</strong> selecting an existing client creates a new proposal based on that client's details, which you can edit.</div>
          </div>
          <div style="float:right; margin-top: 10px;">
          	<img style="width:150px;height:100%;margin-top: 20px;" src="<?php echo $_SESSION['company_logo'] ?>" />
          </div>
		  	
		  
          	<section>
				<br /><br />
			</section>
		
		<section id="holder">
		    <h1 style="color:#404040;clear: both;" class="begining">Client Details</h1>
		    
		    <div class="container">	
			<form id="theform">
				<div class="row">
					<div class="col-sm-6">
												
						<div class="email-form" id="add_field" style="min-width: 800px;">
							<div style="width:100%;">
								<?php echo $client_form ?>
							</div>
							<label style="float: right;">
							<div class="cancel-submit" style="padding:0px; float:right;">
								<ul>
									<li>
										<button id="registerBtn" type="button" onclick="add_client_save(0);">Delete</button>
									</li>
									<li>
										<button id="registerBtn" type="button" onclick="add_client_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
			</form>
		</div>
		    
		    <p><a class="link" href="index.php" data-color="#fff"><button onclick="play_sound(this)" style="width:150px;" type="button" class="btn btn-primary" onclick="clear_proposal_id();">Previous</button></a> | 
		    <a class="" href="javascript:void(0);" data-color="#fff"><button style="width:150px;" type="button" class="btn btn-success" onclick="set_proposal_id();">Next</button></a></p>
		</section>
		
        </div>
      </div>
      
	<img style="width:100%;" src="/images/footer_image.svg" />
    </div>


<script src="<?php echo $website_root ?>/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script type="text/javascript" src="<?php echo $website_root ?>/js/jqxcore.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/jqxdatetimeinput.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/jqxcalendar.js"></script>
	<script type="text/javascript" src="<?php echo $website_root ?>/js/globalize.js"></script>

  </body>
</html>
