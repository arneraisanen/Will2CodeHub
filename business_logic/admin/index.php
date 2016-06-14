<?php
include_once "../../global_paths.php";
session_start();

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in.php';

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "master" )
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
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Admin Dashboard: <?php echo $_SESSION['logged_in']; ?></title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 style="float:left;" class="sub-header">Dashboard Overview</h2><br/>
          <div style="float:right; margin-top: 10px;"><?php echo $fullname . ' (last login: ' . $_SESSION['last_login'] . ')'; ?></div>

          <section>
			<br /><br />
			<ul class="tabs">
				<li class="active">Estimator Accounts summary</li>
				<li>How To</li>
				<li>Useful Links</li>
			</ul>

			<div class="tabs">

				<div>
					<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_estimator_accounts.php"; ?>
				</div>
				
				<div class="js">
					<br /><br />
					<p>The following links point to internal tools (which opens a new window):</p>

					<ul>
						<li><a target="_blank" href="http://www.yourteachers.in/stats/">Statistics</a></li>
						<li><a target="_blank" href="http://www.yourteachers.in/wordpress/wp-admin/">Wordpress (for editing articles only)</a></li>
						<li><a target="_blank" href="#">Email</a></li>
					</ul>
					<br /><br />
				</div>

				<div class="table">
					<p>The HTML shown below is the raw HTML table element, before it has been enhanced by DataTables:</p>
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


<script src="http://www.yourteachers.in/js/bootstrap.min.js"></script>
  </body>
</html>
