<?php
$package_var = $_SESSION['package_type'];

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

$debug_variable = '$proposal_cost = ' . $proposal_cost . '<br />' .
		'$material_cost = ' . $material_cost . '<br />' .
		'$employee_cost = ' . $employee_cost . '<br />' .
		'$guarantee_markup = ' . $guarantee_markup . '<br />' .
		'$company_overhead = ' . $company_overhead . '<br />' .
		'$company_admin_cost = ' . $company_admin_cost . '<br />' .
		'$company_profit_margin = ' . $company_profit_margin . '<br />' .
		'$subcontractors_cost = ' . $subcontractors_cost . '<br />' .
		'$company_sub_con_markup = ' . $company_sub_con_markup . '<br />' .
		'$salesperson_commission = ' . $salesperson_commission . '<br />' .
		'$permit_costs = ' . $permit_costs . '<br />' .
		'$sales_tax = ' . $sales_tax . '<br />' .
		'$sales_tax_total = ' . $sales_tax_total . '<br /><br />';
		
/*
$total_cost += $material_cost;
$total_cost += $employee_cost;
$total_cost += $guarantee_markup;

$percentage_costs = ($total_cost * $company_overhead)/100;  
$percentage_costs += ($total_cost * $company_admin_cost)/100;
$total_cost += $percentage_costs;

$percentage_costs = ($total_cost * $company_profit_margin)/100;
$total_cost += $percentage_costs;

$total_cost += $subcontractors_cost;
$total_cost += ($subcontractors_cost * $company_sub_con_markup)/100;

$salesperson_commission = (($total_cost - $material_cost - $employee_cost - $guarantee_markup - $subcontractor_cost) * $salesperson_commission)/100;

$total_cost += $salesperson_commission;
$total_cost += $permit_costs;

$sales_tax_total = $total_cost + (($total_cost * $sales_tax)/100);
$sales_tax_total = number_format($sales_tax_total, 2, '.', ',');

$total_cost = number_format($total_cost, 2, '.', ',');
$proposal_cost = $total_cost;
*/

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

$sales_tax_var = '';
if ($tax_exemption_number)
	$tax_var = 'Tax Exemption #' . $tax_exemption_number;
else if ($sales_tax)
{
	$tax_var = $sales_tax . '%';
	$sales_tax_var = '<tr style="background-color: #eee;"><td colspan="2" style="height: 40px;vertical-align: middle;"><b>Total Investment </b><br />(including sales tax @' . $sales_tax . '%)</td><td style="text-align:right;height: 40px;vertical-align: middle;">' . $sales_tax_total . '</td></tr>';
}
else 
	$tax_var = 'No tax details provided';

$rental_var = 'No';
if ($client_rental == '1')
	$rental_var = 'Yes';
else 
	$rental_var = 'No';

$credit_card_img_string = '<table CELLPADDING="2" style="margin"100%;margin:10px;">';
$credit_card_img_string .= '<tr><td>' . $payment_options . '</td></tr>';
$credit_card_img_string .= '</table>';

$client_install_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $client_install)));
$client_date_formatted =  date("m-d-Y", strtotime(str_replace('-', '/', $client_date)));

//<tr><td><b>Name:</b> $client_name1</td><td><b>Address:</b> $client_address</td><td rowspan="5" style="text-align:right;">$logo_url</td><td>Name: $company_name</td></tr>

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
<div style="text-align: center;font-size:3em;">Proposal</div>

<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">	
<tr><td></td><td></td><td style="text-align:right;">$logo_url</td></tr>
<tr><td><b>Proposal Number:</b> $proposal_init_number</td><td><b>Address:</b> $client_address</td><td style="text-align:left;">Name: $company_name</td></tr>
<tr><td><b>Name:</b> $client_name2</td><td><b>Address:</b> $client_city, $client_state, $client_zip</td><td style="text-align:left;">Address: $company_address</td></tr>
<tr><td><b>Ph:</b> $client_phone1</td><td><b>Email:</b> $client_email1</td><td style="text-align:left;">Ph: $company_phone</td></tr>
<tr><td><b>Ph:</b> $client_phone2</td><td><b>Rented Property:</b> $rental_var</td><td style="text-align:left;">Salesperson: $salesperson_name</td></tr>
<tr><td><b>Date:</b> $client_date_formatted</td><td></td><td style="text-align:left;">Ph: $salesperson_phone</td></tr>
<tr><td></td><td></td><td colspan="2" style="text-align:left;"><b>$company_website</b></td></tr>
</table>


<div style="text-align: center;font-size:3em;">$package_name</div>


<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;width:100%;height: 90px;vertical-align: middle;"><b>$work:</b></td></tr>
<tr><td></td></tr>
<tr><td>$work_description</td></tr>
<tr><td></td></tr>
<tr><td><b>Install Date:</b> $client_install_formatted</td></tr>
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;width:100%;height: 90px;vertical-align: middle;"><b>$materials:</b></td></tr>
<tr><td></td></tr>
<tr><td>$materials_table</td></tr>
<tr style="height:40px;"><td></td></tr>
$subcontractors_table
<tr><td></td></tr>
<tr style="background-color: #eee; width:100%"><td style="text-align:center; width:100%;height: 90px;vertical-align: middle;"><b>$guarantee:</b></td></tr>
<tr><td></td></tr>
<tr><td style="width:100%;">$guarantee_var</td></tr>
<tr><td></td></tr>
<tr style="background-color: #eee;"><td style="text-align:center;width:100%;height: 90px;vertical-align: middle;"><b>$agreement:</b></td></tr>
<tr><td></td></tr>
<tr><td>$guarantee_agreement</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
</table>

<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">
<tr style="background-color: #eee;"><td style="text-align:left;width:30%;height: 90px;vertical-align: middle;"><b>Permits</b></td><td style="text-align:left;height: 90px;vertical-align: middle;"><b>$investment</b></td><td style="text-align:left;width:10%;height: 90px;vertical-align: middle;"><b>Tax Rate</b></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td colspan="3"><b>$permit_pull_string</b></td><td></td><td></td></tr>
<tr><td>$permit_string</td><td>$payment_terms</td><td>$tax_var</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr style="background-color: #eee;"><td style="height: 90px;vertical-align: middle;" colspan="2"><b>Investment:</b></td><td style="text-align:right;height: 90px;vertical-align: middle;" colspan="2">$proposal_cost</td></tr>
$sales_tax_var
</table>


<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">
<tr><td rowspan="4" style="width:30%;">Payment Options<br /><br />$credit_card_img_string</td><td>$salesperson_name ($salesperson_code)</td></tr>
<tr><td style="width:70%;">Authorization <hr /></td></tr>
<tr><td>$client_name2</td></tr>
<tr><td style="width:70%;">Authorization <hr /></td></tr>
</table>

<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">
<tr><td><b>$instructions</b></td></tr>
<tr><td>$special_instructions</td></tr>
<tr><td></td></tr>
</table>


<table CELLPADDING="2" CELLSPACING="2" style="width: 100%;margin:10px;">
<tr><td style="text-align:left;">Thank you for your business,</td></tr>
<tr><td style="text-align:left;">$salesperson_name,</td></tr>
<tr><td style="text-align:left;">$company_name</td></tr>
<tr><td style="text-align:left;">$client_date_formatted</td></tr>
</table>
EOD;

echo $html_var;

?>