<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$id = $_SESSION['id'];
$fullname = $_SESSION['fullname'];
$site_name = BASE_SITE_NAME;

$profile_image = $website_root . '/profile_images/' . $id . '/thumbnail/' . $id . '.png?rand=' . rand();
$full_path_to_profile_image = $doc_root . '/profile_images/' . $id . '/thumbnail/' . $id . '.png';

if (!file_exists($full_path_to_profile_image)) {
	$profile_image = $website_root . '/profile_images/default_profile.jpg';
}

require_once $doc_root.'/business_logic/admin/db/db_manager.php';
try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM tz_todo ORDER BY id DESC");
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

if ($STH->rowCount() > 0)
{
	$total_todos = '<div id="noti_Container"><div class="noti_bubble">' . $STH->rowCount() . '</div></div>';
}
else
{
	$total_todos = '';
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT date_format(date(startdate),'%Y-%m-%d'), date_format(date(enddate),'%Y-%m-%d') FROM calendar WHERE DATE(startdate) = CURDATE() OR DATE(enddate) = CURDATE();");
	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

if ($STH->rowCount() > 0)
{
	$calendar_items_today = '<div id="noti_Container"><div class="noti_bubble">' . $STH->rowCount() . '</div></div>';
}
else
{
	$calendar_items_today = '';
}

ob_start();
include($doc_root."/business_logic/process/insert_css_and_js_into_header.php");
$insert_css_and_js_into_header = ob_get_contents();
ob_end_clean();

$panel = <<<EOD
  

<div class="navbar navbar-inverse navbar-fixed-top">      
    <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right" style="margin-right: 55px; margin-top: 10px;">
            <li><a href="$website_root/business_logic/admin_tool/signout.php">Sign Out</a></li>
          </ul>
		</div>
	</div>
</div>

    <div class="container-fluid">
      <div class="row">
        <div id="fullscreen_block_menu_hide" class="col-sm-3 col-md-2 sidebar">
          <br /><br />
          <ul class="nav nav-sidebar">
          	<li style="margin-top: -20px; margin-left:-10px; font-wieght:bold;"><a href="$website_root/business_logic/admin_tool/">DASHBOARD <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
          	<div class="menu_section_title">Company</div>
            <li><a href="$website_root/business_logic/admin_tool/company.php">Company Setup</a></li>
            <li><a href="$website_root/business_logic/admin_tool/salesperson.php">Salespeople</a></li>
            <li><a href="$website_root/business_logic/admin_tool/quote_sheet.php">Level Plan</a></li>
            <li><a href="$website_root/business_logic/admin_tool/upload_logo.php">Upload Logo</a></li>
          </ul>
          
          <ul class="nav nav-sidebar">
          	<div class="menu_section_title">Employees</div>
            <li><a href="$website_root/business_logic/admin_tool/employee_management.php">Add/Edit Employees</a></li>
            <!-- <li><a href="$website_root/business_logic/admin_tool/subcontractor_management.php">Subcontractors</a></li> -->
          </ul>
          
          <ul class="nav nav-sidebar">
          	<div class="menu_section_title">Legal Documents</div>
            <li><a href="$website_root/business_logic/admin_tool/license.php">License</a></li>
            <li><a href="$website_root/business_logic/admin_tool/guarantees.php">Add/Edit Guarantee</a></li>
            <li><a href="$website_root/business_logic/admin_tool/agreement.php">Company Agreement</a></li>
            <li><a href="$website_root/business_logic/admin_tool/payment_terms.php">Payment Terms</a></li>
            <li><a href="$website_root/business_logic/admin_tool/payment_options.php">Payment Options</a></li>
          </ul>
          
          <ul class="nav nav-sidebar">
          	<div class="menu_section_title">Math Matrix</div>
            <li><a href="$website_root/business_logic/admin_tool/company_matrix.php">Edit Matrix</a></li>
            <li><a href="$website_root/business_logic/admin_tool/materials.php">Edit Material List</a></li>
          </ul>
          
          <ul class="nav nav-sidebar">
          	<div class="menu_section_title">PDF Settings</div>
            <li><a href="$website_root/business_logic/admin_tool/pdf_titles.php">Edit Section Titles</a></li>
            <li><a href="$website_root/business_logic/admin_tool/pdf_email.php">PDF Email Text</a></li>
          </ul>
        </div>
EOD;

echo $panel;
?>