<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, image, link FROM banner_adverts ORDER BY id ASC LIMIT 3");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";

	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$series_entries = '<div class="row">';
while($row = $STH->fetch())
{
	$link = $row["link"];
	$image = $row["image"];
	
	$series_entries .= '
			<div class="col-lg-4">
				<a target="_blank" class="" href="' . $link . '"><img class="" src="' . $image . '" width="200" height="200"></a>
			</div>';
}
$series_entries .= '</div>';
echo $series_entries;