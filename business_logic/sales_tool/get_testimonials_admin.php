<?php
require_once '../admin/db/db_manager.php';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, image, text FROM testimonials ORDER BY id ASC");
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
	$series_entries .= '<td>' . $row["text"] . '</td>';
	$series_entries .= '<td>' . $row["image"] . '</td>';
	$series_entries .= '<td><div style="width:120px;"><a href="edit_testimonials.php?action=0&id=' . $row["id"] . '"><button type="button" class="btn btn-sm btn-success">Edit</button></a> </td></tr>';
	$count++;
}
echo $series_entries;