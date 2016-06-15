<?php
include "../../global_paths.php";
require_once '../admin/db/db_manager.php';

$username= $_POST['username'];
$type_flag= $_POST['type_flag'];

if ($type_flag == 1)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("DELETE FROM users WHERE username = :username");
		
		$STH->bindParam(':username', $username);
		$STH->execute();
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

echo "Entry deleted from DB";

?>