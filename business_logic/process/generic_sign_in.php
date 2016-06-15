<?php

include "../../global_paths.php";

session_start();
session_unset();
session_destroy();
session_start();
$username = $_POST["email"];
$password = $_POST["password"];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in.php';
$admin_homepage = 'Location: ' . $website_root . '/business_logic/admin_tool/';
$sales_homepage = 'Location: ' . $website_root . '/business_logic/sales_tool/';
$master_homepage = 'Location: ' . $website_root . '/business_logic/admin/';
$unverfied_user_homepage = 'Location: ' . $website_root;// . '/business_logic/unverified_user.php';
$generic_homepage_placeholder = '';


if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] == "admin" )
	{
		header($admin_homepage);
		exit;
	}
	else if ( $_SESSION['role'] == "sales" )
	{
		header($teacher_homepage);
		exit;
	}
	else if ( $_SESSION['role'] == "master" )
	{
		header($master_homepage);
		exit;
	}
}
else
{
	require_once '../admin/db/db_manager.php';
	
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
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
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
					echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details. " . $e->getMessage();
					file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
					exit;
				}
				
				switch ($row["role"])
				{
					case 'master':
						$generic_homepage_placeholder = $master_homepage;
						break;
						
					case 'admin':
						$generic_homepage_placeholder = $admin_homepage;
						break;
						
					case 'sales':
						try
						{
							$company_id = $row["company_id"];
							$DBH3 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
							$DBH3->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
						
							$STH3 = $DBH2->prepare("SELECT logo FROM company WHERE id='$company_id'");
							$STH3->execute();
						
							$STH3->setFetchMode(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
							file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
							exit;
						}
						
						while($row3 = $STH3->fetch())
						{
							$company_logo = $row3["logo"];
							$_SESSION['company_logo'] = $company_logo;
						}
						
						$generic_homepage_placeholder = $sales_homepage;
						break;
				}
				
				header($generic_homepage_placeholder);
				exit;
			}
			else
			{
				header($sign_in);
				exit;
			}
		}
	}
}
header($sign_in);