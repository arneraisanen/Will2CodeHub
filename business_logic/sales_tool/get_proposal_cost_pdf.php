<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];

$package_var = $_SESSION['package_type'];

$guarantee_markup = '';
switch ($package_var)
{
	case 'platinum':
		$guarantee_markup = $guarantee_best_markup;
		break;

	case 'gold':
		$guarantee_markup = $guarantee_better_markup;
		break;
			
	case 'basic':
		$guarantee_markup = $guarantee_good_markup;
		break;
}

/*
Material Cost (sum of all materials multipled by the unit cost of each material and the quantity of each material ordered)
+
Employee Cost (sum of each employees hours to be worked on this project multipled by their hourly rate)
+
Guarantee Markup (a fixed value markup for whichever package we are generating the quote for)
= SUM_A
 
Company Overhead (percentage of SUM_A)
+
Admin Costs (percentage of SUM_A)
+
Company Profit Margin (percentage of SUM_A)
= SUM_B

SUM_C = SUM_A + SUM_B

Subcontractor Cost (Each contractor has a rate which is summed if that contractor is used in this work order)
+
Subcontractor Commission (a percentage of the Subcontractor cost)
=
SUM_D

SUM_E = SUM_C + SUM_D

Salesperson Commission ( (SUM_E - SUM_A - (subcontractors cost) x (Salesperson Commission %))/100 )
+
Permit Costs (Only included if Pull Permit is set)
=
SUM_F

SUM_G = SUM_E + SUM_F

Sales Tax (only included if no tax permit number is entered)
+
SUM_G
=
TOTAL
*/

/* The following are test values added into the Estimator tool, used to verify the calculations are accurate 
	$proposal_cost = 1,201.05
	$material_cost = 48.3
	$employee_cost = 366
	$guarantee_markup = 100
	$company_overhead = 25
	$company_admin_cost = 10
	$company_profit_margin = 20
	$subcontractors_cost = 200
	$company_sub_con_markup = 5
	$salesperson_commission = 32.89
	$permit_costs = 125
	$sales_tax = 8
	$sales_tax_total = 1,297.14
*/

$total_cost = 0;
$percentage_costs = 0; /* These are the percentages added to the base cost for the work, and are calculated individually on this base cost */

if ($pull_permit)
	$permit_costs = $permit_cost1 + $permit_cost2 + $permit_cost3 + $permit_cost4;
else
	$permit_costs = 0;

$total_cost += $material_cost;
$total_cost += $employee_cost;
$total_cost += $guarantee_markup;
//514.3

$percentage_costs = ($total_cost * $company_overhead)/100;  //128.58
$percentage_costs += ($total_cost * $company_admin_cost)/100; //51.43
$total_cost += $percentage_costs; //694.31

$percentage_costs = ($total_cost * $company_profit_margin)/100; //138.86
$total_cost += $percentage_costs; //833.17

$total_cost += $subcontractors_cost; //1033.17
$total_cost += ($subcontractors_cost * $company_sub_con_markup)/100; //1043.17

$salesperson_commission = (($total_cost - $material_cost - $employee_cost - $guarantee_markup - $subcontractors_cost) * $company_salesperson_commission)/100;
$salesperson_commission = number_format($salesperson_commission, 2, '.', ',');
// 32.89

$total_cost += $salesperson_commission; //1076.06
$total_cost += $permit_costs; // 1201.06

$sales_tax_total = $total_cost + (($total_cost * $sales_tax)/100); // 1297.14
$sales_tax_total = number_format($sales_tax_total, 2, '.', ',');

$total_cost = number_format($total_cost, 2, '.', ',');
$proposal_cost = $total_cost;
?>