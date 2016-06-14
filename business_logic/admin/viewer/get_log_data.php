<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$DBH3 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$DBH3->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );	

$access_log_url = $_GET['log'];
$url = $_GET['url'];

function detect_hack_attempt(PDO $DBH2, PDO $DBH3, $hack_warning_lines)
{
	try 
	{
		$STH2 = $DBH2->prepare("SELECT attack_vector FROM viewer_attack_vectors");
		$STH2->execute();

		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) 
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details: " . $e->getMessage();
		file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}

	while($row2 = $STH2->fetch())
	{
		$vector2 = $row2['attack_vector'];	
		$pos2 = strpos($hack_warning_lines, $vector2);

		if ($pos2 !== false) 
		{
			try 
			{
				$STH3 = $DBH3->prepare("SELECT attack_vector FROM viewer_attack_vectors_ignore");
				$STH3->execute();

				$STH3->setFetchMode(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e) 
			{
				echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details: " . $e->getMessage();
				file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
				exit;
			}

			while($row3 = $STH3->fetch())
			{
				$vector3 = $row3['attack_vector'];

				if ($hack_warning_lines == $vector3) 
				{
					$STH3 = $DBH3->prepare("INSERT INTO viewer_attack_vectors_ignore ( attack_vector ) values ( '$hack_warning_lines' )");
					$STH3->execute();
					return 1;
				}
				else
					continue;
			}
		}
		else
			return 0;
	}
	
	return 0;
}

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$STH = $DBH->prepare("SELECT id, num_lines, hours FROM viewer_settings");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details: " . $e->getMessage();
    file_put_contents('error_log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


$attack_lines = '';
while($row = $STH->fetch())
{
	$num_of_lines_db = $row['num_lines'];
	$hours = $row['hours'];
}

	function tailShell($filepath, $lines = 1) {
		ob_start();
		passthru('tail -'  . $lines . ' ' . escapeshellarg($filepath));
		return trim(ob_get_clean());
	}
	
	//$filepath = '/var/log/httpd/nhrda-admin/nhrda.com-access_log';
	//$filepath = 'nhrda.com-access_log';
	$filepath = $access_log_url;
	
	//echo 'Log File Parser - last 100 lines<br /><br />';
	$text_file = tailShell($filepath, $num_of_lines_db);
	$text_file = explode("\n", $text_file);
	//print_r($text_file);
	$number_of_lines = sizeof($text_file);
	//echo 'NUMBER OF LINES = ' . $number_of_lines;
	
	$current_line = 0;
	$data_array = '{ "data": [ [';
	
	foreach ($text_file as $line_str) 
	{
		$pattern[0] = '/(\[)(.*)(\])/msUi';
		$replacement[0] = '"$2"';
		$line_str_exploded = preg_replace($pattern, $replacement, $line_str);
		$line_str_exploded = str_getcsv($line_str_exploded, ' ', '');
		
		$count = 0;	
		$hack_warning_line = '';	
		foreach ($line_str_exploded as $line_str_exploded_text) 
		{
			$line_str_exploded_text = str_replace('"', "", $line_str_exploded_text);
			
			if ( ($count == 1) || ($count == 2) )
				;
			else if ($count == 3)
			{
				$data_array .= '"' . $line_str_exploded_text . '", ' . $data_array_ip;
				$hack_warning_line .= '"' . $line_str_exploded_text . '", ' . $data_array_ip;
			}
			else if ($count == 4)
			{
				$pattern[0] = '/( )(\/.*)( )/msUi';
				$replacement[0] = ' <a href=\"http://' . $url . '$2\" target=\"_blank\">$2</a> ';
				$line_str_exploded_text = preg_replace($pattern, $replacement, $line_str_exploded_text);
				
				$data_array .= ', "' . $line_str_exploded_text . '"';
				$hack_warning_line .= ', "' . $line_str_exploded_text . '"';
			}
			else if ($count == 5)
			{
				$data_array .= ', "' . $line_str_exploded_text . '"';
				$hack_warning_line .= ', "' . $line_str_exploded_text . '"';
			}
			else if ($count == 6)
			{
				$data_array .= ', "' . $line_str_exploded_text . '"';
				$hack_warning_line .= ', "' . $line_str_exploded_text . '"';
			}
			else if ($count == 7)
			{
				$data_array .= ', "<a href=\"' . $line_str_exploded_text . '\" target=\"_blank\">' . $line_str_exploded_text . '</a>"';
				$hack_warning_line .= ', "<a href=\"' . $line_str_exploded_text . '\" target=\"_blank\">' . $line_str_exploded_text . '</a>"';
			}
			else if ($count > 7)
			{
				//$logTimestamp = strtotime("{$results['date']} {$results['time']} {$results['timezone']}");
				//$sqlTimestamp = date('Y-m-d H:i:s', $logTimestamp);
				$data_array .= ', "' . $line_str_exploded_text . '"';
				$hack_warning_line .= ', "' . $line_str_exploded_text . '"';
			}
			else
				$data_array_ip = '"<a href=\"http://www.tcpiputils.com/browse/ip-address/' . $line_str_exploded_text . '\" target=\"_blank\">' . $line_str_exploded_text . '</a>"';
		
			$count++;
		}
		
		if (detect_hack_attempt($DBH2, $DBH3,$hack_warning_line))
			;//$attack_lines .= "<br /><br />" . $hack_warning_line;
		
		$current_line++;
		
		if ($current_line < $number_of_lines)
			$data_array .= '], [';
	}
	
	$data_array .= '] ]}';
	
	$file_array_data =  "arrays.txt";
	$fp = fopen($file_array_data,'w');
	$write = fwrite($fp,$data_array);
	$fp = fclose($fp);
	
	if ($attack_lines)
	{
		$headers = "From: apache_log_viewer\r\n";
		$headers .= "Reply-To: admin@themunicheye.com\r\n";
		$headers .= "CC: admin@themunicheye.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = "<html><body>";
		$message .= "The following Apache access log entries, contain potential hack attempts.  These were identifed by a positive string match with the NHRDA database hack vectors:<br /><br />" . $attack_lines;
		$message .= "</body></html>";
		//$msg = wordwrap($msg,70);
		//mail("editor@themunicheye.com","Apache Log Viewer: Potential Hack Attempt",$message, $headers);
		//mail("fail2@jexperformance.com","Test",$msg);
	}
	
?>