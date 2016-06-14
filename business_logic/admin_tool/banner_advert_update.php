<?php
require_once '../admin/db/db_manager.php';

$id= $_POST['id'];
$link= $_POST['ad_link'];
$name= $_POST['ad_name'];
$image= $_POST['ad_image'];


try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("UPDATE banner_adverts SET link = :link, name = :name, image = :image WHERE id = :id");
	
	$STH->execute(array(
	':id' => $id,
	':link' => $link,
	':name' => $name,
	':image' => $image
	));
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

echo "Banner advert updated";

?>