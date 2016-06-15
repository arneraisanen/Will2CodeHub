<?php
include "../../../global_paths.php";
/* Database config */
include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/db/db_manager.php";
/* End config */


$link = @mysql_connect($host,$user,$pass) or die('Unable to establish a DB connection');

mysql_set_charset('utf8');
mysql_select_db($dbname,$link);

?>