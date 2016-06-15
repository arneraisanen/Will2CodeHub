<?php

include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

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

$series_entries = '<div class="container">     
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Labor Hours</th>
      </tr>';


$count = 1;
while($row = $STH->fetch())
{
	$hours = '';
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$employee_id_tmp = $row["id"];
		$STH2 = $DBH2->prepare("SELECT hours FROM proposal_employee_hours WHERE employee_id='$employee_id_tmp' AND proposal_id='$proposal_id' AND package_type='platinum'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	if ($STH2->rowCount() > 0)
	{
		while($row2 = $STH2->fetch())
		{
			$hours = $row2["hours"];
		}
	}
	
	
	$series_entries .= '<tr>
        <td>' . $count . '</td>
        <td id="field_1_add">' . $row["id"] . '</td>
        <td>' . $row["name"] . '</td>
        <td style="width: 10%;"><input id="employee_value_' . $row["id"] . '_platinum" onchange="add_employee_hours(\'' . $row["id"] . '\', \'platinum\')" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $hours . '"/></td>';
	
	$count++;
}
$series_entries .= '</thead>
<tbody>
</tbody>
</table>
</div>';

echo $series_entries;