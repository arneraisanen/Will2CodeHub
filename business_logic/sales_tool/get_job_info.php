<?php
//session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$salesperson_id = $_SESSION['id'];
$client_id = $_SESSION['client_id'];
$proposal_id = $_SESSION['proposal_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT best, better, good FROM quote_sheet WHERE company_id='$company_id'");
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
	$best = $row["best"];
	$better = $row["better"];
	$good = $row["good"];
}

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name1, name2, address, city, state, phone1, phone2, email, date, rental, install, best, better, good FROM client WHERE company_id='$company_id' AND id='$client_id' AND proposal_id='$proposal_id'");
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

if ($STH->rowCount() == 0)
{
	$series_entries .= '
	' . $best . ' Work Description <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text"></textarea>
	' . $better . ' Work Description <textarea rows="8" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text"></textarea>
	' . $good . ' Work Description <textarea rows="8" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text"></textarea><br /><br />';
}
while($row = $STH->fetch())
{  
	$series_entries .= '
	' . $best . ' Work Description <textarea rows="8" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text">' . $row["best"] . '</textarea>
	' . $better . ' Work Description <textarea rows="8" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text">' . $row["better"] . '</textarea>
	' . $good . ' Work Description <textarea rows="8" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text">' . $row["good"] . '</textarea><br /><br />';
}

$DBH=null;
echo $series_entries;
?>