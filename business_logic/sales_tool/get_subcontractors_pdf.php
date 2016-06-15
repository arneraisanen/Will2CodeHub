<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];
$package_type = $_SESSION['package_type'];

$subcontractors_table = '<table CELLPADDING="2" CELLSPACING="2" style="width:100%;margin:10px;">
    <thead>
      <tr>
        <th>#</th>
        <th>Trade Name</th>
        <th>Contractor</th>
        <th>Comments</th>
      </tr>
	</thead>
	<tbody><tr><td></td><td></td><td></td></tr>';

$subcontractors_cost = 0;
settype($subcontractors_cost, "float");
$count = 1;


try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$employee_id_tmp = $row["employee_id"];
	$STH2 = $DBH2->prepare("SELECT id, name, trade_name, rate, description FROM subcontractors WHERE company_id='$company_id' AND proposal_id='$proposal_id' AND package_type='$package_type' ORDER BY id ASC");
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
		$subcontractors_table .= '<tr>
	        <td>' . $count . '</td>
	        <td>' . $row2["trade_name"] . '</td>
	        <td>' . $row2["name"] . '</td>
	        <td>' . $row2["description"] . '</td></tr>';
		
		$subcontractors_cost += $row2["rate"];

		$count++;
	}
}


$subcontractors_table .= '
</tbody>
</table>';

if ($count == 1)
	$subcontractors_table = '';
?>