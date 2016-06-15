<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, payment_type FROM payment_options WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$image_style = 'style="width:30px;float:left;"';
$count = 1;
$payment_options = '<table cellspacing="5"><tr>';

while($row = $STH->fetch())
{  	
	if ($count%3 == 0)
	{
		$image_style = 'style="width:30px;float:left;"';
		$image_new_line = '</tr><tr>';
	}
	else 
	{
		$image_style = 'style="width:30px;float:left;"';
		$image_new_line = '';
	}
	
	switch($row["payment_type"])
	{
		case 'Visa':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/visa.jpg" /></td>' . $image_new_line;
			break; 

		case 'Mastercard':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/mastercard.jpg" /></td>' . $image_new_line;
			break;

		case 'Diners Club':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/diners_club.jpg" /></td>' . $image_new_line;
			break;

		case 'Paypal':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/paypal.jpg" /></td>' . $image_new_line;
			break;

		case 'American Express':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/american_express.jpg" /></td>' . $image_new_line;
			break;

		case 'Solo':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/solo.jpg" /></td>' . $image_new_line;
			break;

		case 'Discover':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/discover.jpg" /></td>' . $image_new_line;
			break;

		case 'Check':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/check.jpg" /></td>' . $image_new_line;
			break;

		case 'Cash':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/cash.jpg" /></td>' . $image_new_line;
			break;

		case 'E-Check':
			$payment_options .= '<td valign="middle" style="text-align:center;vertical-align:middle"><img ' . $image_style . ' src="/images/payment_options/echeck.png" /></td>' . $image_new_line;
			break;
	}
	
	$count++;
}

$payment_options .= '</tr></table>';

?>