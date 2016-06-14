<?php

function extract_data($html_str)
{
	echo '<br /><br /><br />' . $html_str;
	/*
	 * 
	 <body>
<ul class="navigation">
  <li class="sheet0"><a href="#sheet0">Sheet1</a></li>
  <li class="sheet1"><a href="#sheet1">Sheet2</a></li>
  <li class="sheet2"><a href="#sheet2">Sheet3</a></li>
</ul>
<style>
@page { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
body { left-margin: 0.7in; right-margin: 0.7in; top-margin: 0.75in; bottom-margin: 0.75in; }
</style>
	<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
		<col class="col0">
		<col class="col1">
		<col class="col2">
		<col class="col3">
		<col class="col4">
		<col class="col5">
		<col class="col6">
		<col class="col7">
		<col class="col8">
		<col class="col9">
		<tbody>
		  <tr class="row0">
			<td class="column0 style1 s style2" colspan="10">EBONYI STATE</td>


	 */
	
	$pattern = '/<td class="column0 style1 s style2" colspan="10">(.*)<\/td>/ms';
	//([^<]*?)<\/td>((?!tr).)*<td class="column2 style[0-9][0-9] n">([0-9]{4})<\/td>((?!tr).)*<td class="column' . $regex_index . ' style[0-9][0-9] n">([0-9]{1,3})<\/td>/ms';
	preg_match_all($pattern, $html_str, $matches, PREG_SET_ORDER);
	
	foreach ($matches as $val)
	{
		$count++;
		$state = $val[1];

		//echo 'STATE: ' . $val[0] . '<br />';
	
		/*
		try
		{
			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
			$STH = $DBH->prepare("INSERT INTO points ( nhrda_number, class, name, points, tiebreak, season, event, series, class_date_pos ) values ( :nhrda_number, :class, :name, :points, :tiebreak, :season, :event, :series, :class_date_pos )");
	
			$STH->bindParam(':nhrda_number', $nhrda_number);
			$STH->bindParam(':class', $class);
			$STH->bindParam(':name', $name);
			$STH->bindParam(':points', $points);
			$STH->bindParam(':tiebreak', $count);
			$STH->bindParam(':season', $season);
			$STH->bindParam(':event', $event);
			$STH->bindParam(':series', $series);
			$STH->bindParam(':class_date_pos', $class_date_pos);
			$STH->execute();
		}
		catch(PDOException $e)
		{
			echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
			file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
			exit;
		}
		*/
	}
}


foreach(glob('docdir/*.*') as $file)
{
	$hdle = fopen($file,'r');
	$html_str = fread($hdle, filesize($file));
	
	extract_data($html_str);
	$hdle = fclose($hdle);
}
?>