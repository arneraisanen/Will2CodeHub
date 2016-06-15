<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];
$package_type = $_SESSION['package_type'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, material_id, quantity FROM proposal WHERE company_id='$company_id' AND proposal_id='$proposal_id' AND type_field='$package_type'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$materials_table = '<table CELLPADDING="2" CELLSPACING="2">
    <thead>
      <tr>
        <th style="width:10%">#</th>
        <th style="width:10%">SKU</th>
        <th style="width:65%">Description</th>
        <th style="width:10%">Quantity</th>
      </tr>
	</thead>
	<tbody><tr><td></td><td></td><td></td></tr>';

$count = 1;
$material_cost = 0;
settype($material_cost, "float");
while($row = $STH->fetch())
{
	$material_id = $row["material_id"];
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT id, cost, ska, description FROM materials WHERE id='$material_id'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	while($row2 = $STH2->fetch())
	{
		$materials_table .= '<tr>
	        <td style="width:10%">' . $count . '</td>
	        <td style="width:10%">' . $row2["ska"] . '</td>
	        <td style="width:65%">' . $row2["description"] . '</td>
	        <td style="width:10%">' . $row["quantity"] . '</td></tr>';

		$material_cost += $row2["cost"] * $row["quantity"];
	}
	$count++;
}

$materials_table .= '
</tbody>
</table>';
?>