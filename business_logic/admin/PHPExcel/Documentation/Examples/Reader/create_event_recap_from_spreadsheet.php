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
//$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/images/' . $event_name . '/event_recap/event_recap_x5.xls';
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/include_files/event_recap/event_recap.xls';
//$inputFileName = '../../../../../images/IDS/event_recap/event_recap_x5.xls';
//$inputFileName = 'event_recap_x5.xls';
echo $inputFileName . '<br /><br />';


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


$objReader = PHPExcel_IOFactory::createReader($inputFileType);
/*
$chunkSize = 1;
$chunkFilter = new chunkReadFilter();
$objReader->setReadFilter($chunkFilter);
*/
$objPHPExcel = $objReader->load($inputFileName);
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$writer->writeAllSheets();
$writer->save($_SERVER['DOCUMENT_ROOT'].'/include_files/event_recap/event_recap.html');


/**  Loop to read our worksheet in "chunk size" blocks  **/
/*
for ($startRow = 0; $startRow <= 1000; $startRow += $chunkSize) 
{
	
	echo '<br >startRow = ' . $startRow;
	$chunkFilter->setRows($startRow,$chunkSize);
	$objPHPExcel = $objReader->load($inputFileName);
	//	Do some processing here

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	//var_dump($sheetData);
	//echo $sheetData[1]['A'];
	
	foreach ($sheetData as $val) 
	{
		echo $val["A"];
	}
}
*/

echo 'EOF';
?>