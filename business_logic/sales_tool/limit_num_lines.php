<?php

$line_limit = $_POST['line_limit'];
$hour_limit = $_POST['hour_limit'];

require_once '../db/db_manager.php';
 
try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE viewer_settings SET num_lines = :line_limit, hours = :hour_limit WHERE id = '1'");
	
	$STH->execute(array(
    ':line_limit' => $line_limit,
    ':hour_limit' => $hour_limit
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

?>