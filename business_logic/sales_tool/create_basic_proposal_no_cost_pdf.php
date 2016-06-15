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
$_SESSION['package_type'] = 'basic';

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
	$company_email
	$company_logo
	$company_overhead
	$company_profit_margin
	$company_salesperson_commission
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
	$guarantee_agreement
*/
require $doc_root.'/business_logic/sales_tool/get_salesperson_pdf.php';
/*
	$salesperson_name
	$salesperson_phone
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
include($doc_root.'/business_logic/admin/pdf_html_template_no_cost.php');
$html = ob_get_contents();
ob_end_clean();

// Extend the TCPDF class to create custom Header and Footer

if (!class_exists('MYPDF')) {
	class MYPDF extends TCPDF {
	    //Page header
	    public function Header() {
	        // get the current page break margin
	        $bMargin = $this->getBreakMargin();
	        // get current auto-page-break mode
	        $auto_page_break = $this->AutoPageBreak;
	        // disable auto-page-break
	        $this->SetAutoPageBreak(false, 0);
			$img_file = '';//$company_logo;
	        //$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
	        // restore auto-page-break status
	        $this->SetAutoPageBreak($auto_page_break, $bMargin);
	        // set the starting point for the page content
	        $this->setPageMark();
	    }
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($company_name);
$pdf->SetTitle($company_name . ': Proposal');
$pdf->SetSubject($client_name1 . ' Proposal from ' . $company_name);
$pdf->SetKeywords($company_name . ', ' . $client_name1 . ', ' . $client_name2 . ', proposal');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 8, '', true);

$pdf->setPrintHeader(true);

//$pdf->setJPEGQuality(100);
//$pdf->Image('../../images/pdf_background_template_1.png', 0, 34, 750, 1020, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, true);

$pdf->setPrintHeader(true);
$pdf->AddPage();
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->setPrintFooter(true);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

$user_filename = $doc_root.'/business_logic/sales_tool/autogenerated_pdfs/' . $_SESSION['package_type'] . '_special_order_pdf_' . $client_name1 . '_' . $client_id . '_' . $proposal_id . '.pdf';
$server_pdf_filename = '/business_logic/sales_tool/autogenerated_pdfs/' . $_SESSION['package_type'] . '_special_order_pdf_' . $client_name1 . '_' . $client_id . '_' . $proposal_id . '.pdf';
$pdf->Output($user_filename, 'F');

echo $server_pdf_filename;
?>