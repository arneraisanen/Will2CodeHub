<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$file_name = $_POST['field_1_update'];
$id_var = $_POST['field_2_update'];

$target_dir = "./sheets/";
if (!file_exists($target_dir))
{
	mkdir($target_dir, 0777, true);
}

if(isset($_POST['submit_file2']))
{
  $uploadfile=$_FILES["upload_file2"]["tmp_name"];
  $folder=$target_dir;
  move_uploaded_file($_FILES["upload_file2"]["tmp_name"], $folder.$_FILES["upload_file2"]["name"]);
  rename($folder.$_FILES["upload_file2"]["name"],$folder.$file_name . '.xls');
  
  try
  {
  	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  	$STH = $DBH->prepare("UPDATE material_default_lists SET list_title = :list_title WHERE id=:id_var");
  
  	$STH->bindParam(':id_var', $id_var);
  	$STH->bindParam(':list_title', $file_name);
  	$STH->execute();
  }
  catch(PDOException $e)
  {
  	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
  	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
  	exit;
  }
  
  require_once $doc_root.'/business_logic/admin/PHPExcel/Documentation/Examples/Reader/update_material_list_items.php';
  
  header("Location: http://www.arbco.org/business_logic/admin/material_list.php");
  exit();
}
?>