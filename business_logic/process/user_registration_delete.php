<?php
session_start();
require_once '../admin/db/db_manager.php';

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];

if ( isset($_SESSION['logged_in']) )
{
	if ( $_SESSION['role'] != "admin" )
	{
		echo "You do not have the necessary permissions to delete users";
		exit;
	}
}
else
{
	echo "You do not have the necessary permissions to delete users";
	exit;
}

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare('DELETE FROM user_details WHERE id = :id');
  	$STH->bindParam(':id', $id);
	$STH->execute();
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "The profile of " . $firstname . " " . $surname . " was successfully deleted";

?>