<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$id = $_POST['field_1_add'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name, phone, email, commission, proposal_init_number, password FROM salesperson WHERE id='$id'");
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
	$series_entries .= $row["name"] . '<<<!separator!>>>' . $row["phone"] . '<<<!separator!>>>' . $row["email"] . '<<<!separator!>>>' . $row["commission"] . '<<<!separator!>>>' . $row["password"] . '<<<!separator!>>>' . $row["proposal_init_number"];
}

$DBH=null;
echo $series_entries;
?>