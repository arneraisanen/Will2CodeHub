<?php
include "../../global_paths.php";
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
$sign_in = 'Location: ' . $website_root;// . '/business_logic/sign_in.php';

session_start();
session_unset();
session_destroy();
header($sign_in);
?>