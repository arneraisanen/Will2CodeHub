<?php
$test_server = false;
$client= 'arbco';

if ($test_server == true)
{
	$host = 'localhost';
	$dbname = 'conifer_db_main';
	$user = 'root';
	$pass = '';	
}
else
{
	if ($client == 'arbco')
	{
		$host = 'localhost';
		$dbname = 'conifer';
		$user = 'conifer_user';
		$pass = 'con_2424';
	}
	else
	{
		$host = 'localhost';
		$dbname = 'conifer_demo';
		$user = 'conifer_demo_u';
		$pass = 'demo_2424';
	}
}
?>