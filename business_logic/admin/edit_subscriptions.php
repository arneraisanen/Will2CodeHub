<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, one_month, three_month, six_month, twelve_month FROM license_prices");
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
	$series_entries = '<div style="width:300px;">
	<form action="upload_materials_list.php" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
		1 Month <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["one_month"] . '"/>
		3 Months <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["three_month"] . '"/>
		6 Months <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["six_month"] . '"/>
		12 Months <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["twelve_month"] . '"/>';	
}

echo $series_entries;
?>