<?php
$package_var = $_SESSION['package_type'];
$company_id = $_SESSION['company_id'];

switch ($package_var)
{
	case 'platinum':
		$package_name = $package_name_best;
		$guarantee_var = $guarantee_platinum;
		$work_description = $client_work_desc_best;
		break;
		
	case 'gold':
		$package_name = $package_name_better;
		$guarantee_var = $guarantee_gold;
		$work_description = $client_work_desc_better;
		break;
			
	case 'basic':
		$package_name = $package_name_good;
		$guarantee_var = $guarantee_basic;
		$work_description = $client_work_desc_good;
		break;
}

$salesperson_code = 'IDCODE: ' . floor($salesperson_commission);

//$logo_url = '<img href="http://arbco.org' . $company_logo . '" />';
$logo_url = '<img style="height: 120px;float:right;margin: 30px;" src="http://arbco.org/images/logos/' . $company_id . '/logo.png" /> ';

$permit_pull_string = '';
$permit_string = '';
if ($pull_permit)
{
	$permit_pull_string = 'Company to pull permit: Yes';
	
	$permit_string = '<table CELLPADDING="2">';
	if ($permit_type1)
		$permit_string .= '<tr><td>' . $permit_type1 . '</td></tr>';
	if ($permit_type2)
		$permit_string .= '<tr><td>' . $permit_type2 . '</td></tr>';
	if ($permit_type3)
		$permit_string .= '<tr><td>' . $permit_type3 . '</td></tr>';
	if ($permit_type4)
		$permit_string .= '<tr><td>' . $permit_type4 . '</td></tr>';
	$permit_string .= '</table>';
}
else
{
	$permit_pull_string = 'Permit by other';
}

if ( !$permit_type1 && !$permit_type2 && !$permit_type3 && !$permit_type4 )
	$permit_string = 'No permits provided';

if ($tax_exemption_number)
	$tax_var = 'Tax Exemption #' . $tax_exemption_number;
else if ($sales_tax)
{
	$tax_var = $sales_tax;
	$sales_tax_var = 'Total (with sales tax included): $' . $sales_tax_total;
}
else 
	$tax_var = 'No tax details provided';

$rental_var = 'No';
if ($client_rental == '1')
	$rental_var = 'Yes';
else
	$rental_var = 'No';

$credit_card_img_string = '<table CELLPADDING="2">';
$credit_card_img_string .= '<tr><td>' . $payment_options . '</td></tr>';
$credit_card_img_string .= '</table>';

$client_install_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $client_install)));
$client_date_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $client_date)));

if($subcontractors_table != '')
{
	$sub_contractor_rows = '<tr style="background-color: #eee;"><td style="text-align:center;"><b>' . $sub_contractors . ':</b></td></tr>
	<tr><td></td></tr>
	<tr><td>' . $subcontractors_table . '</td></tr>
	<tr><td></td></tr>';
}
else 
	$sub_contractor_rows = '';

$html_var = <<<EOD
<div style="text-align: center;font-size:66px;">Proposal</div>
<br /><br /><br />

<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">	
<tr><td></td><td></td><td style="text-align:right;">$logo_url</td></tr>
<tr><td><b>Proposal Number:</b> $proposal_init_number</td><td><b>Address:</b> $client_address</td><td style="text-align:left;">Name: $company_name</td></tr>
<tr><td><b>Name:</b> $client_name2</td><td><b>Address:</b> $client_city, $client_state, $client_zip</td><td style="text-align:left;">Address: $company_address</td></tr>
<tr><td><b>Ph:</b> $client_phone1</td><td><b>Email:</b> $client_email1</td><td style="text-align:left;">Ph: $company_phone</td></tr>
<tr><td><b>Ph:</b> $client_phone2</td><td><b>Rented Property:</b> $rental_var</td><td style="text-align:left;">Salesperson: $salesperson_name</td></tr>
<tr><td><b>Date:</b> $client_date_formatted</td><td></td><td style="text-align:left;">Ph: $salesperson_phone</td></tr>
<tr><td></td><td></td><td colspan="2" style="text-align:left;"><b>$company_website</b></td></tr>
</table>

<br /><br />
<div style="text-align: center;font-size:56px;">$package_name</div>
<br /><br />
				
<table CELLPADDING="2" CELLSPACING="2">
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;"><b>$work:</b></td></tr>
<tr><td></td></tr>
<tr><td>$work_description</td></tr>
<tr><td></td></tr>
<tr><td><b>Install Date:</b> $client_install_formatted</td></tr>
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;"><b>$materials:</b></td></tr>
<tr><td></td></tr>
<tr><td>$materials_table</td></tr>
<tr><td></td></tr>
$subcontractors_table
<tr><td></td></tr>
<tr style="background-color: #eee; width:100%"><td style="text-align:center; width:100%"><b>$guarantee:</b></td></tr>
<tr><td></td></tr>
<tr><td>$guarantee_var</td></tr>
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;"><b>$agreement:</b></td></tr>
<tr><td></td></tr>
<tr><td>$guarantee_agreement</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
</table>

<br /><br />

<table CELLPADDING="2" CELLSPACING="2">
<tr style="background-color: #eee;"><td style="text-align:left;"><b>Permits:</b></td><td style="text-align:left;"><b>$investment</b></td><td style="text-align:left;"><b>Tax Rate</b></td></tr>
<tr><td><b>$permit_pull_string</b></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td>$permit_string</td><td>$payment_terms</td><td>$tax_var</td></tr>
<tr><td></td><td></td><td></td></tr>
</table>

<br /><br />

<table CELLPADDING="2" CELLSPACING="2">
<tr><td rowspan="4" style="width:30%;">Payment Options<br /><br />$credit_card_img_string</td><td>$salesperson_name ($salesperson_code)</td></tr>
<tr><td style="width:70%;">Authorization <hr /></td></tr>
<tr><td>$client_name2</td></tr>
<tr><td style="width:70%;">Authorization <hr /></td></tr>
</table>

<br /><br />

<table CELLPADDING="2" CELLSPACING="2">
<tr><td><b>$instructions</b></td></tr>
<tr><td>$special_instructions</td></tr>
<tr><td></td></tr>
</table>

<br /><br /><br /><br />

<table CELLPADDING="2" CELLSPACING="2">
<tr><td style="text-align:left;">Thank you for your business,</td></tr>
<tr><td style="text-align:left;">$salesperson_name,</td></tr>
<tr><td style="text-align:left;">$company_name</td></tr>
<tr><td style="text-align:left;">$client_date_formatted</td></tr>
</table>

EOD;

echo $html_var;

?>