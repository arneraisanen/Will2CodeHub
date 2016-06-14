<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$username= $_POST['username'];
$password= $_POST['password'];
$firstname= $_POST['firstname'];
$surname= $_POST['surname'];
$role= $_POST['role'];
$project= $_POST['project'];
$type_flag= $_POST['type_flag'];

if ($type_flag == 1)
{
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("INSERT INTO users ( username, password, firstname, surname, role, project ) values ( :username, :password, :firstname, :surname, :role, :project )");
	
		$STH->bindParam(':username', $username);
		$STH->bindParam(':password', $password);
		$STH->bindParam(':firstname', $firstname);
		$STH->bindParam(':surname', $surname);
		$STH->bindParam(':role', $role);
		$STH->bindParam(':project', $project);
		$STH->execute();
		
		$id = $DBH->lastInsertId();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

echo "The entry " . $specialisation . " was successfully added to the database";

?>