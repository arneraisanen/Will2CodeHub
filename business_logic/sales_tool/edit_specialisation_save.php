<?php
require_once '../admin/db/db_manager.php';

$specialisation= $_POST['specialisation'];
$specialisation_old= $_POST['specialisation_old'];
$type_flag= $_POST['type_flag'];

if ($type_flag == 1)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE subject SET subject = :subject WHERE subject = :specialisation_old");
		
		$STH->execute(array(
		':subject' => $specialisation,
		':specialisation_old' => $specialisation_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else if ($type_flag == 2)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE cities SET city = :specialisation WHERE city = :specialisation_old");
		
		$STH->execute(array(
		':specialisation' => $specialisation,
		':specialisation_old' => $specialisation_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
else if ($type_flag == 3)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$STH = $DBH->prepare("UPDATE state SET state = :specialisation WHERE state = :specialisation_old");
		
		$STH->execute(array(
		':specialisation' => $specialisation,
		':specialisation_old' => $specialisation_old
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

echo "DB list updated";

?>