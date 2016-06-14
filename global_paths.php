<?php
$site="ARBCO";
//$site="ARBCO";
//$site="TME Demo";

switch ($site)
{
	case "TME Demo":
		define('BASE_PATH', __DIR__);
		define('BASE_WEBSITE_PATH', 'www.demos.themunicheye.com');
		define('BASE_SITE_NAME', 'Demo Frontpage');
	break;
	
	case "NHRDA":
		define('BASE_PATH', __DIR__);
		define('BASE_WEBSITE_PATH', 'www.nhrda.com/conifer');
		define('BASE_SITE_NAME', 'NHRDA');
	break;
	
	case "ARBCO":
		define('BASE_PATH', __DIR__);
		define('BASE_WEBSITE_PATH', 'www.arbco.org');
		define('BASE_SITE_NAME', 'ARBCO');
	break;
	
	case "ARBCO_DEV":
		define('BASE_PATH', __DIR__);
		define('BASE_WEBSITE_PATH', 'www.arbco.org/dev');
		define('BASE_SITE_NAME', 'ARBCO');
	break;
	
	case "ARBCO_DEBUG":
		if (!defined('BASE_PATH'))
			define('BASE_PATH', __DIR__);
		if (!defined('BASE_WEBSITE_PATH'))
			define('BASE_WEBSITE_PATH', 'localhost');
		if (!defined('BASE_SITE_NAME'))
			define('BASE_SITE_NAME', 'ARBCO');
	break;

	default:
		define('BASE_PATH', __DIR__);
		define('BASE_WEBSITE_PATH', 'www.demos.themunicheye.com');
		define('BASE_SITE_NAME', 'Demo Frontpage');
		break;
}

$_SERVER['DOCUMENT_ROOT'] = BASE_PATH;
$_SERVER['SERVER_NAME'] = BASE_WEBSITE_PATH;
?>