<?php

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Driver Excel Sheet Read</title>

</head>
<body>

<h1>Driver Excel Sheet Read</h1>
<h2>Read the driver excel sheet and save to temp DB</h2>
<?php

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$inputFileType = 'Excel5'; 
$sheetname = 'Members 2014'; 
$inputFileName = '../../../../../driver/2014 Membership List 04-12-14-web.xlsx';
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
//$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


echo '<hr />';


/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */ 
class MyReadFilter implements PHPExcel_Reader_IReadFilter 
{ 
    public function readCell($column, $row, $worksheetName = '') { 
        //  Read rows 1 to 7 and columns A to E only 
        if ($row >= 1 && $row <= 7) { 
            if (in_array($column,range('A','E'))) { 
                return true; 
            } 
        } 
        return false; 
    } 
} 

/**  Create an Instance of our Read Filter  **/ 
$filterSubset = new MyReadFilter(); 

/**  Create a new Reader of the type defined in $inputFileType  **/ 
$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
/**  Tell the Reader that we want to use the Read Filter  **/ 
$objReader->setReadFilter($filterSubset); 
/**  Load only the rows and columns that match our filter to PHPExcel  **/ 
$objPHPExcel = $objReader->load($inputFileName); 

//$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//var_dump($sheetData);
var_dump($in_array);


?>
<body>
</html>