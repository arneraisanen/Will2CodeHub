<?php
include_once "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
session_start();

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in_estimator_sales.php';

ob_start();
include($doc_root."/business_logic/sales_tool/get_job_info.php");
$client_form = ob_get_contents();
ob_end_clean();

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
         		<img id="info_button" style="cursor: pointer;float: left;clear: both; margin-top: 50px;" src="/images/info.png" title="Click to Toggle Page Instructions" alt="Click to Toggle Page Instructions" /><br /><div id="info_div" style="display:none;z-index: 1000;width: 400px;margin: 10px 10px 60px;float: right;clear: both;border-radius: 10px;padding: 15px;color: #ddd;background-color: #5c9112;">This is the page where you provide a description of the different work packages your company provides. This information is included in the respective PDF generated for that package.</div>
         	</div>
          <div style="float:right; margin-top: 10px;"><img style="width:150px;height:100%;margin-top: 20px;" src="<?php echo $_SESSION['company_logo'] ?>" /></div>
		  
          	<section>
				<br /><br />
			</section>
		
		<section id="holder">
		    <h1 style="color:#404040;clear: both;" class="begining">Client Job Information</h1>
		    
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
										<button id="registerBtn" type="button" onclick="add_job_info_save(1);">Save</button>
									</li>
								</ul>
							</div>
							</label>
						</div>
					</div>
				</div>
			</form>
		</div>
		    
		    <p><a class="link" href="index2.php" data-color="#fff"><button onclick="play_sound(this)" style="width:150px;" type="button" class="btn btn-primary">Previous</button></a> | 
		    <a class="link" href="index4.php" data-color="#fff"><button onclick="play_sound(this)" style="width:150px;" type="button" class="btn btn-success">Next</button></a></p>
		    <br /><br />
		    <p>Or choose a page to edit: </p>
			<form id="theform2" style="width: 610px;margin: auto;">
			    <button style="" id="registerBtn15" type="button"><a href="index2.php">Client Details</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index4.php">Materials</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index5.php">Sub Contractors</a></button> 
			    <button style="" id="registerBtn15" type="button"><a href="index6.php">Permits/Sales Tax</a></button>
			    <button style="" id="registerBtn15" type="button"><a href="index7.php">PDF Creation</a></button>
			</form> 
		</section>
		
        </div>
      </div>
      
	<img style="width:100%;" src="/images/footer_image.svg" />
    </div>


<script src="<?php echo $website_root ?>/js/bootstrap.min.js"></script>
  </body>
</html>
