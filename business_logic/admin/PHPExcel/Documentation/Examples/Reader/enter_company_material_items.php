<?php
session_start();
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$id_var = $company_id;
$file_name = $company_id;


error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');

/**  Set Include path to point at the PHPExcel Classes folder  **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/**  Include PHPExcel_IOFactory  **/
include($_SERVER['DOCUMENT_ROOT'].'/business_logic/admin/PHPExcel/Classes/PHPExcel/IOFactory.php');


$inputFileType = 'Excel5';
//	$inputFileType = 'Excel2007';
//	$inputFileType = 'Excel2003XML';
//	$inputFileType = 'OOCalc';
//	$inputFileType = 'Gnumeric';
$inputFileName = $_SERVER['DOCUMENT_ROOT'] . '/business_logic/admin/sheets/' . $file_name . '.xls';


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

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("DELETE FROM materials WHERE company_id = '$id_var'");

	$STH->execute();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

/**  Create a new Reader of the type defined in $inputFileType  **/
$objReader = PHPExcel_IOFactory::createReader($inputFileType);

/**  Define how many rows we want to read for each "chunk"  **/
$chunkSize = 250;
/**  Create a new Instance of our Read Filter  **/
$chunkFilter = new chunkReadFilter();

/**  Tell the Reader that we want to use the Read Filter that we've Instantiated  **/
$objReader->setReadFilter($chunkFilter);

for ($startRow = 2; $startRow <= 4000; $startRow += $chunkSize) {
	//echo 'Loading WorkSheet using configurable filter for headings row 1 and for rows ',$startRow,' to ',($startRow+$chunkSize-1),'<br />';
	//  Tell the Read Filter, the limits on which rows we want to read this iteration
	$chunkFilter->setRows($startRow,$chunkSize);
	//  Load only the rows that match our filter from $inputFileName to a PHPExcel Object
	$objPHPExcel = $objReader->load($inputFileName);

	//	Do some processing here

	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	//var_dump($sheetData);
	//echo $sheetData[1]['A'];
	
	foreach ($sheetData as $val) 
	{
		if ($val["C"] != NULL)
		{
			try 
			{
				$val["C"] = str_replace('$', '', $val["C"]);
				
				$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
				$STH = $DBH->prepare("INSERT INTO materials ( company_id, ska, description, cost ) VALUES ( :company_id, :ska, :description, :cost)");
				
				$STH->bindParam(':company_id', $company_id);
				$STH->bindParam(':ska', $val["A"]);
				$STH->bindParam(':description', $val["B"]);
				$STH->bindParam(':cost', $val["C"]);
				$STH->execute();
			}
			catch(PDOException $e) 
			{
				echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
				echo $e->getMessage();
				file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
				exit;
			}
		}
	}
}

?>