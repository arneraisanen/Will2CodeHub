<?php

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Parse Driver Db Spreadsheet</title>

</head>
<body>

<h1>Driver Spreadsheet Data</h1>
<h2>What follows is a listing from the driver DB spreadsheet</h2>
<?php

$inputFileType = 'Excel5'; 
$inputFileName = '../../../../../driver/2014 Membership List 04-12-14-web.xlsx'; 


/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */ 
class chunkReadFilter implements PHPExcel_Reader_IReadFilter 
{ 
    private $_startRow = 0; 
    private $_endRow   = 0; 

    /**  Set the list of rows that we want to read  */ 
    public function setRows($startRow, $chunkSize) { 
        $this->_startRow = $startRow; 
        $this->_endRow   = $startRow + $chunkSize; 
    } 

    public function readCell($column, $row, $worksheetName = '') { 
        //  Only read the heading row, and the configured rows 
        if (($row == 1) ||
            ($row >= $this->_startRow && $row < $this->_endRow)) { 
            return true; 
        } 
        return false; 
    } 
} 


/**  Create a new Reader of the type defined in $inputFileType  **/ 
$objReader = PHPExcel_IOFactory::createReader($inputFileType); 


/**  Define how many rows we want to read for each "chunk"  **/ 
$chunkSize = 2048; 
/**  Create a new Instance of our Read Filter  **/ 
$chunkFilter = new chunkReadFilter(); 

/**  Tell the Reader that we want to use the Read Filter  **/ 
$objReader->setReadFilter($chunkFilter); 

/**  Loop to read our worksheet in "chunk size" blocks  **/ 
for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) { 
    /**  Tell the Read Filter which rows we want this iteration  **/ 
    $chunkFilter->setRows($startRow,$chunkSize); 
    /**  Load only the rows that match our filter  **/ 
    $objPHPExcel = $objReader->load($inputFileName); 
    //    Do some processing here 
} 
?>
<body>
</html>
