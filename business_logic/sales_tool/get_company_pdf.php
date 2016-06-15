<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name, address, phone, website, email, color, logo, overhead, profit_margin, salesperson_commission, admin_cost, sub_con_markup, salesperson_edit_matrix FROM company WHERE company_id='$company_id'");
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
	$company_name = $row["name"];
	$company_address = $row["address"];
	$company_phone = $row["phone"];
	$company_website = $row["website"];
	$company_color = $row["color"];
	$company_email = $row["email"];
	$company_logo = $row["logo"];
	$company_overhead = $row["overhead"];
	$company_profit_margin = $row["profit_margin"];
	$company_salesperson_commission = $row["salesperson_commission"];
	$company_admin_cost = $row["admin_cost"];
	$company_sub_con_markup = $row["sub_con_markup"];
}

if ($row["salesperson_edit_matrix"] == 1)
{
	$client_id = $_SESSION['client_id'];
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT overhead, profit_margin, admin_cost, sub_con_markup FROM client WHERE id='$client_id'");
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
		$company_profit_margin = $row["profit_margin"];
		$company_sub_con_markup = $row["sub_con_markup"];
	}
}
?>