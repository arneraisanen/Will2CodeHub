<?php
error_reporting(E_ALL);
set_time_limit(0);
date_default_timezone_set('Europe/London');

/**  Set Include path to point at the PHPExcel Classes folder  **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/**  Include PHPExcel_IOFactory  **/
include $_SERVER['DOCUMENT_ROOT'].'/admin/PHPExcel/Classes/PHPExcel/IOFactory.php';


$inputFileType = 'Excel5';
//	$inputFileType = 'Excel2007';
//	$inputFileType = 'Excel2003XML';
//	$inputFileType = 'OOCalc';
//	$inputFileType = 'Gnumeric';



/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */
class chunkReadFilter implements PHPExcel_Reader_IReadFilter
{
	private $_startRow = 0;

	private $_endRow = 0;

	/**  Set the list of rows that we want to read  */
	public function setRows($startRow, $chunkSize) {
		$this->_startRow	= $startRow;
		$this->_endRow		= $startRow + $chunkSize;
	}

	public function readCell($column, $row, $worksheetName = '') {
		//  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow
		//if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {
		if (($row >= $this->_startRow && $row < $this->_endRow)) {
			return true;
		}
		return false;
	}
}

$ajax_response = '';
$count=0;
foreach(glob($_SERVER['DOCUMENT_ROOT'].'/include_files/points_sheets/*.*') as $file) 
{
	$count++;
	$ajax_response .= basename($file) . '<br />';
	$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/include_files/points_sheets/' . basename($file);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName);
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
	$writer->writeAllSheets();
	$writer->save($_SERVER['DOCUMENT_ROOT'].'/include_files/points_sheets/html_pages/' . basename($file, '.xls') . '.html');
}

$ajax_response .= '<br /><br />';
$ajax_response_start = 'The following ' . $count . ' files were found under /include_files/points_sheets/ and read (see tabs below for details):<br /><br />';

echo $ajax_response_start . $ajax_response;

?>