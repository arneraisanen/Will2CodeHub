<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$username= $_POST['username'];

ob_start();
include($doc_root."/business_logic/admin/csr_scripts/get_projects.php");
$projects = ob_get_contents();
ob_end_clean();

require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, username, password, role, firstname, surname, project FROM users WHERE username = '$username'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '';                         
while($row = $STH->fetch())
{  
	switch($row["role"])
	{
		case 'admin':
			$tmp_var = '<select class="form-control" id="csr_role"><option SELECTED value="admin">Admin</option><option value="professional">Professional</option><option value="user">User</option></select>';
			break;
			
		case 'professional':
			$tmp_var = '<select class="form-control" id="csr_role"><option value="admin">Admin</option><option SELECTED value="professional">Professional</option><option value="user">User</option></select>';
			break;
				
		case 'user':
			$tmp_var = '<select class="form-control" id="csr_role"><option value="admin">Admin</option><option value="professional">Professional</option><option SELECTED value="user">User</option></select>';
			break;				
	}
	
	$series_entries .= '
			Username <input id="csr_username" name="csr_username" class="form-control" data-trigger="focus" type="text" value="' . $row["username"] . '"/>
			Password <input id="csr_password" name="csr_password" class="form-control" data-trigger="focus" type="text" value="' . $row["password"] . '"/>
			Firstname <input id="csr_firstname" name="csr_firstname" class="form-control" data-trigger="focus" type="text" value="' . $row["firstname"] . '"/>
			Surname <input id="csr_surname" name="csr_surname" class="form-control" data-trigger="focus" type="text" value="' . $row["surname"] . '"/>
			Role ' . $tmp_var . '
			Project <select id="csr_project" name="csr_project" class="form-control"><option SELECTED value="' . $row["project"] . '">' . $row["project"] . '</option>' . $projects . '</select>';
}

$DBH=null;
echo $series_entries;
?>