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
	
		$STH = $DBH->prepare("SELECT overhead, profit_margin, salesperson_commission, admin_cost, sub_con_markup, salesperson_edit_matrix FROM company WHERE company_id='$company_id'");
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
		if ($row["salesperson_edit_matrix"])
			$salesperson_edit_matrix = 'checked';
		else 
			$salesperson_not_edit_matrix = 'checked';
		
		$series_entries .= '
		Company Overhead <input style="width:25%;" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["overhead"] . '"/>
		Desired Profit Margin <input style="width:25%;" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["profit_margin"] . '"/>
		<input type="hidden" style="width:25%;" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["salesperson_commission"] . '"/>
		Administration Cost <input style="width:25%;" id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["admin_cost"] . '"/>
		Sub-contractor Mark Up <input style="width:25%;" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value="' . $row["sub_con_markup"] . '"/>
		<br />Allow Salesperson Matrix Editing 
			<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio1" ' . $salesperson_edit_matrix . '>Yes</label></div>
			<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio2" ' . $salesperson_not_edit_matrix . '>No</label></div><br /><br />';
	}
}
else
{
	$series_entries = '
		Company Overhead <input style="width:25%;" id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Desired Profit Margin <input style="width:25%;" id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Salesperson Commission <input style="width:25%;" id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Administration Cost <input style="width:25%;" id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
		<br />Sub-contractor Mark Up <input style="width:25%;" id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus" type="text" value=""/>
			Allow Salesperson Matrix Editing 
			<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio1">Yes</label></div>
			<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio2" CHECKED>No</label></div><br /><br />';
}

$DBH=null;
echo $series_entries;
?>