<?php
session_start();
$website_root = 'http://'. $_SERVER['SERVER_NAME'] . '/';
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$location = 'Location: ' . $website_root . 'business_logic/sign_in_estimator_admin.php';

if ($_SESSION['role'] == "master")
	$location = 'Location: ' . $website_root . 'business_logic/sign_in.php';
if ($_SESSION['role'] == "admin")
	$location = 'Location: ' . $website_root . 'business_logic/sign_in_estimator_admin.php';

if ( isset($_SESSION['logged_in']) )
{
	if ( ($_SESSION['role'] != "master") && ($_SESSION['role'] != "admin") )
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
			}
			else
			{
				header($location);
				exit;
			}
		}
	}
	else
	{
		header($location);
		exit;
	}
}
?>