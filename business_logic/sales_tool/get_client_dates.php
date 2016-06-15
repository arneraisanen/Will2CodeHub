<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$client_date_formatted = '';
$install_date_formatted = '';

if (isset($_SESSION['client_id']))
{
	$client_id = $_SESSION['client_id'];
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT date, install FROM client WHERE id='$client_id'");
		$STH->execute();
	
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	 

	while($row = $STH->fetch())
	{  
				
		$client_date_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $row["date"])));
		$install_date_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $row["install"])));
	}
}
else 
{
	$client_date_formatted = '';
	$install_date_formatted = '';
}
?>