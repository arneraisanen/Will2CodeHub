<?php
session_start();
$company_id = $_SESSION['company_id'];

$target_dir = "../../images/logos/" . $company_id . "/logo.png";
if (file_exists($target_dir)) 
{
	echo '<img id="logo_image_current" style="width: 200px;" src="' . $target_dir . '" />';
}
else
	echo 'No logo uploaded';

?>