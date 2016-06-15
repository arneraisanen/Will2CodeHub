<?php
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$company_id = $_SESSION['company_id'];
$proposal_id = $_SESSION['proposal_id'];
$fullname = $_SESSION['fullname'];
$timestamp = date("Y-m-d H:i:s");
$_SESSION['package_type'] = 'gold';

require $doc_root.'/business_logic/sales_tool/get_pdf_titles_pdf.php';
/*
 $work
 $materials
 $sub_contractors
 $guarantee
 $agreement
 $investment
 $instructions
 */
require $doc_root.'/business_logic/sales_tool/get_company_pdf.php';
/*
	$company_name
	$company_address
	$company_phone
	$company_website
	$company_color
	$company_email
	$company_logo
	$company_overhead
	$company_profit_margin
	$company_admin_cost
	$company_sub_con_markup
*/
require $doc_root.'/business_logic/sales_tool/get_client_pdf.php';
/*
	$client_id
	$client_name1
	$client_name2
	$client_address
	$client_city
	$client_state
	$client_zip
	$client_phone1
	$client_phone2
	$client_email1
	$client_email2
	$client_date
	$client_rental
	$client_install
	$client_work_desc_best
	$client_work_desc_better
	$client_work_desc_good
*/
require $doc_root.'/business_logic/sales_tool/get_guarantee_pdf.php';
/*
	$guarantee_platinum
	$guarantee_gold
	$guarantee_basic
	$guarantee_best_markup
	$guarantee_better_markup
	$guarantee_good_markup
	$guarantee_agreement
*/
require $doc_root.'/business_logic/sales_tool/get_salesperson_pdf.php';
/*
	$salesperson_name
	$salesperson_phone
	$company_salesperson_commission
*/
require $doc_root.'/business_logic/sales_tool/get_package_names_pdf.php';
/*
	$package_name_best
	$package_name_better
	$package_name_good
*/
require $doc_root.'/business_logic/sales_tool/get_materials_pdf.php';
/*
	$materials_table
*/
require $doc_root.'/business_logic/sales_tool/get_subcontractors_pdf.php';
/*
	$subcontractors_table
*/
require $doc_root.'/business_logic/sales_tool/get_permit_pdf.php';
/*
	$pull_permit
	$permit_type1
	$permit_cost1
	$permit_type2
	$permit_cost2
	$permit_type3
	$permit_cost3
	$permit_type4
	$permit_cost4
	$sales_tax
	$tax_exemption_number
	$special_instructions
*/
require $doc_root.'/business_logic/sales_tool/get_employees_pdf.php';
/*
	$employees_cost
*/
require $doc_root.'/business_logic/sales_tool/get_proposal_cost_pdf.php';
/*
	$proposal_cost
*/
require $doc_root.'/business_logic/sales_tool/get_payment_terms_pdf.php';
/*
	$payment_terms
*/
require $doc_root.'/business_logic/sales_tool/get_payment_options_pdf.php';
/*
	$payment_options
*/

ob_start();
include($doc_root.'/business_logic/admin/pdf_html_template_text.php');
$html = ob_get_contents();
ob_end_clean();

echo $html;
?>