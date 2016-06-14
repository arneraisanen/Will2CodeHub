<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, rate FROM employees WHERE company_id='$company_id' ORDER BY id ASC");
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
$count = 1;
while($row = $STH->fetch())
{
	$series_entries .= '<tr><td>' . $count . '</td>';
	$series_entries .= '<td>' . $row["name"] . '</td>';
	$series_entries .= '<td>' . $row["rate"] . '</td>';
	$series_entries .= '<td><div style="width:120px;"><a href="edit_employees.php?action=0&id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a> </td>';
	$series_entries .= '<td><div style="width:120px;"><a href="edit_employees.php?action=1&id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-success">Delete</button></a> </td></tr>';
	$count++;
}
echo $series_entries;