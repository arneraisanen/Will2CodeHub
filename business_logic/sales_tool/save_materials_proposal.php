<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$material_id= $_POST['field_1_add'];
$type_field= $_POST['field_2_add'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT quantity FROM proposal WHERE company_id='$company_id' AND proposal_id='$proposal_id' AND type_field='$type_field'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$quantity = 1;
while($row = $STH->fetch())
{
	$quantity = $row["quantity"];
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("INSERT INTO proposal ( company_id, material_id, proposal_id, type_field, quantity ) values ( :company_id, :material_id, :proposal_id, :type_field, :quantity )");

	$STH->bindParam(':material_id', $material_id);
	$STH->bindParam(':proposal_id', $proposal_id);
	$STH->bindParam(':company_id', $company_id);
	$STH->bindParam(':type_field', $type_field);
	$STH->bindParam(':quantity', $quantity);
	$STH->execute();
	
	$id = $DBH->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, description, cost FROM materials WHERE id='$material_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
/*$series_entries = '<tr id="material_proposal_row_' . $id . '">
        <td>' . $id . '</td>
        <td>' . $row["description"] . '</td>
        <td>' . $row["cost"] . '</td>
        <td><button onclick="delete_material_proposal(\'' . $id . '\')" type="button" class="btn btn-danger">Delete</button></td></tr>';
*/
$series_entries = $id . '<<<!separator!>>>' . $row["description"] . '<<<!separator!>>>' . $row["cost"] . '<<<!separator!>>>' . $type_field . '<<<!separator!>>>' . $quantity;
}

echo $series_entries;

?>