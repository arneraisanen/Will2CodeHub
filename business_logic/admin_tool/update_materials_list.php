<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id_var = $company_id;

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
  rename($folder.$_FILES["upload_file2"]["name"],$folder.$id_var . '.xls');
  
  require_once $doc_root.'/business_logic/admin/PHPExcel/Documentation/Examples/Reader/update_material_list_items.php';
  
  header("Location: http://www.arbco.org/business_logic/admin_tool/materials.php");
  exit();
}
?>