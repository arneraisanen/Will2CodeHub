<?php

include "../../global_paths.php";

session_start();
session_unset();
session_destroy();
session_start();
$username = $_POST["email"];
$password = $_POST["password"];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root . '/business_logic/sign_in_estimator_sales.php';
$admin_homepage = 'Location: ' . $website_root . '/business_logic/admin_tool/';
$sales_homepage = 'Location: ' . $website_root . '/business_logic/sales_tool/';
$master_homepage = 'Location: ' . $website_root . '/master/';
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
		header($sales_homepage);
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
	
		$STH = $DBH->prepare("SELECT id, name, password, email, last_login, company_id FROM salesperson WHERE email='$username' AND password='$password'");
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
			if ($row["email"] == $username)
			{
				$_SESSION['logged_in'] = $row["name"];
				$_SESSION['role'] = 'sales';
				$_SESSION['id'] = $row["id"];
				$_SESSION['company_id'] = $row["company_id"];
				$_SESSION['fullname'] = $row["name"];
				$_SESSION['last_login'] = $row["last_login"];
				$datetime_var = date("Y-m-d H:i:s");
				$_SESSION['company_logo'] = 'http://www.arbco.org/images/logos/' . $_SESSION['company_id'] . '/logo.png';
				$company_logo = $_SESSION['company_logo'];
				
				try
				{
					$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
					$STH2 = $DBH2->prepare("UPDATE salesperson SET last_login = :last_login WHERE id = :id");
				
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
				
				switch ($_SESSION['role'])
				{
					case 'admin':
						$generic_homepage_placeholder = $admin_homepage;
						break;
						
					case 'sales':
						try
						{
							$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
							$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
						
							$STH2 = $DBH2->prepare("UPDATE company SET logo = :logo WHERE company_id = :company_id");
							$STH2->execute(array(
									':company_id' => $_SESSION['company_id'],
									':logo' => $company_logo
							));
						}
						catch(PDOException $e)
						{
							echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
							file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
							exit;
						}
						
						$generic_homepage_placeholder = $sales_homepage;
						break;
						
					case 'master':
						$generic_homepage_placeholder = $master_homepage;
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
	else
	{	
		try
		{
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
			$STH = $DBH->prepare("SELECT id, name, password, last_login FROM salesperson WHERE email='$username' AND password='$password'");
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
				if ( ($row["email"] == $username) )
				{
					$_SESSION['logged_in'] = $row["email"];
					$_SESSION['role'] = "sales";
					$_SESSION['id'] = $row["id"];
					$_SESSION['fullname'] = $row["name"];
					$datetime_var = date("Y-m-d H:i:s");
					$_SESSION['last_login'] = $row["last_login"];
		
					try
					{
						$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
						$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
						$STH2 = $DBH2->prepare("UPDATE salesperson SET last_login = :last_login WHERE id = :id");
		
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
		
					header($sales_homepage);
					exit;
				}
				else
				{
					header($sign_in);
					exit;
				}
			}
		}
		else /* school's log in section */
		{
			try
			{
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
				$STH = $DBH->prepare("SELECT id, name, password, last_login FROM salesperson WHERE email='$username' AND password='$password'");
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
					if ( ($row["email"] == $username) )
					{
						if (!$row["verified"])
						{
							header($unverfied_user_homepage);
							exit;
						}
			
						$_SESSION['logged_in'] = $row["email"];
						$_SESSION['role'] = "master";
						$_SESSION['id'] = $row["id"];
						$_SESSION['fullname'] = $row["name"];
						$datetime_var = date("Y-m-d H:i:s");
						$_SESSION['last_login'] = $row["last_login"];
			
						try
						{
							$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
							$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
							$STH2 = $DBH2->prepare("UPDATE salesperson SET last_login = :last_login WHERE id = :id");
			
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
			
						header($master_homepage);
					}
					else
					{
						header($sign_in);
						exit;
					}
				}
			}
		}
	}
}
header($sign_in);