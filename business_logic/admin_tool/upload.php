<?php
session_start();
$company_id = $_SESSION['company_id'];

$target_dir = "../../images/logos/" . $company_id . "/";
if (!file_exists($target_dir)) {
	mkdir($target_dir, 0777, true);
}

if(isset($_POST['submit_image']))
{
  $uploadfile=$_FILES["upload_file"]["tmp_name"];
  $folder=$target_dir;
  move_uploaded_file($_FILES["upload_file"]["tmp_name"], $folder.$_FILES["upload_file"]["name"]);
  rename($folder.$_FILES["upload_file"]["name"],$folder.'logo.png');
  echo '<h3>New Logo</h3><br /><img src="'.$folder. 'logo.png?ref=987878787" />';
  exit();
}
?>