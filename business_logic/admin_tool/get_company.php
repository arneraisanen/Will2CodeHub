<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id FROM company WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


if ($STH->rowCount() > 0)
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT name, address, phone, website, email, color, logo FROM company WHERE company_id='$company_id'");
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
		$series_entries .= '
		Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["name"] . '"/>
		Address <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["address"] . '"/>
		Phone <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["phone"] . '"/>
		Website <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["website"] . '"/>
		Email <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["email"] . '"/><br /><br />';
	}
}
else
{
	$series_entries = '
	Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Address <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Phone <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Website <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Email <input id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/><br /><br />';
}

$DBH=null;
echo $series_entries;
?>