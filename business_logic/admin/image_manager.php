<?php
session_start();
$website_root = 'http://'. $_SERVER['SERVER_NAME'] . '/';
$location = 'Location: ' . $website_root . 'business_logic/sign_in.php';

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "admin" )
	{
		header($location);
		exit;
	}
}
else
{
	$username = $_POST["email"];
	$password = $_POST["password"];
	
	require_once '../admin/db/db_manager.php';
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT username, password, role FROM users WHERE username='$username' AND password='$password'");
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
				//include($doc_root.'/business_logic/admin/get_log_data.php');
			}
			else
			{
				header($location);
			}
		}
	}
	else
		header($location);
}
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>ToDo Task List</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">ToDo Task List</h2><iframe src="jquery_file_upload/index.html" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="1000px"></iframe>
		</div>
      </div>
    </div>



  </body>
</html>