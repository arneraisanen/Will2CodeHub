<?php
include "../../global_paths.php";
require_once '../admin/db/db_manager.php';

$username= $_POST['username'];
$new_username= $_POST['new_username'];
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
		
		$STH = $DBH->prepare("UPDATE users SET username = :new_username, password = :password, firstname = :firstname, surname = :surname, role = :role, project = :project WHERE username = :username");
		
		$STH->execute(array(
		':username' => $username,
		':new_username' => $new_username,
		':password' => $password,
		':firstname' => $firstname,
		':surname' => $surname,
		':role' => $role,
		':project' => $project
		));
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
echo "DB list updated";

?>