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
  <nav>
  <ul class="list-unstyled main-menu">

    <!--Include your navigation here-->
    <li class="text-right"><a href="#" id="nav-close">X</a></li>
    <li><a href="$website_root/business_logic/admin/edit_profile_image.php">Edit Profile Image <span class="icon"></span></a></li>
    <li><a href="$website_root/business_logic/admin/show_professional_profile.php?action=0&id=$id">Edit Profile <span class="icon"></span></a></li>
    <li><a target="_blank" href="$website_root/business_logic/user_profile_view.php?id=$id">View Profile <span class="icon"></span></a></li>
    <li><a href="#">Change Password <span class="icon"></span></a></li>
    <li><a href="#">Email Helpdesk <span class="icon"></span></a></li>
    <!--
    <li><a href="#">Dropdown</a>
      <ul class="list-unstyled">
          <li class="sub-nav"><a href="#">Sub Menu One <span class="icon"></span></a></li>
          <li class="sub-nav"><a href="#">Sub Menu Two <span class="icon"></span></a></li>
          <li class="sub-nav"><a href="#">Sub Menu Three <span class="icon"></span></a></li>
          <li class="sub-nav"><a href="#">Sub Menu Four <span class="icon"></span></a></li>
          <li class="sub-nav"><a href="#">Sub Menu Five <span class="icon"></span></a></li>
      </ul>
    </li>
    -->
  </ul>
</nav>

<div class="navbar navbar-inverse navbar-fixed-top">      
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="$website_root">$site_name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right" style="margin-right: 55px; margin-top: 10px;">
            <li id="exit_fullscreen_item" style="display:none;"><a href="javascript:void(0)" onclick="exitFullscreen();">Exit Fullscreen</a></li>
            <li  data-toggle="tooltip" data-placement="bottom" title="Enter fullscreen mode" id="enter_fullscreen_item"><a href="javascript:void(0)" onclick="launchIntoFullscreen(document.documentElement);">Fullscreen</a></li>
            <li id="exit_fullwidth_item" style="display:none;"><a href="javascript:void(0)" onclick="exitFullwidth();">Exit Fullwidth</a></li>
            <li id="enter_fullwidth_item"><a href="javascript:void(0)" onclick="launchIntoFullwidth(document.documentElement);">Fullwidth</a></li>
            <li><a href="$website_root/business_logic/admin/index.php">Dashboard</a></li>
            <li><a href="$website_root/business_logic/admin/signout.php">Sign Out</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        
	    <div class="navbar-header pull-right">
	      <a id="nav-expander" class="nav-expander fixed" data-toggle="tooltip" data-placement="bottom" title="Edit profile details">
	        <img id="profile_image_icon" style="width:30px; margin-top: -5px;" src="$profile_image"> &nbsp;<i class="fa fa-bars fa-lg white"></i>
	      </a>
	    </div>
        </div>
      </div>
</div>

    <div class="container-fluid">
      <div class="row">
        <div id="fullscreen_block_menu_hide" class="col-sm-3 col-md-2 sidebar">
          <br /><br />
          <ul class="nav nav-sidebar">
          	<li style="margin-top: -20px; margin-left:-10px; font-wieght:bold;"><a href="$website_root/business_logic/admin/index.php">DASHBOARD <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <div class="menu_section_title">CSR</div>
            <li><a href="$website_root/business_logic/admin/csr_scripts/">CSR Scripts</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <div class="menu_section_title">Estimator Software</div>
            <li><a href="$website_root/business_logic/admin/company.php">Add/Edit Companies</a></li> 
            <li><a href="$website_root/business_logic/admin/administrator.php">Add/Edit Administrators</a></li> 
            <li><a href="$website_root/business_logic/admin/license.php">Edit Licenses</a></li> 
            <li><a href="$website_root/business_logic/admin/subscriptions.php">Edit Subscription Prices</a></li>
            <!--<li><a href="$website_root/business_logic/admin/material_list.php">Add/Edit Material Lists</a></li>-->
          </ul>
        </div>
EOD;

echo $panel;
?>