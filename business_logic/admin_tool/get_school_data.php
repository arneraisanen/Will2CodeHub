<?php
require_once '../admin/db/db_manager.php';	

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, contact_first_name, contact_surname, school_name, email, mobile, password, district, address1, address2, address3, pin, verified, online FROM schools ORDER BY id ASC");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$count=0;
$total_entries = $STH->rowCount();
$series_entries = '{ "data": [ ';                         
while($row = $STH->fetch())
{  
	if ($count < ($total_entries - 1))
		$series_entries .= '["' . $row["id"] . '", "' . $row["contact_first_name"] . '", "' . $row["contact_surname"] . '", "' . $row["email"] . '", "' . $row["mobile"] . '", "' . $row["school_name"] . '", "' . $row["address1"] . '", "' . $row["address2"] . '", "' . $row["address3"] . '", "' . $row["district"] . '", "' . $row["verified"] . '", "' . $row["online"] . '", "<div style=\"width:120px;\"><a href=\"show_school_profile.php?action=0&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-success\">Edit</button></a> <a href=\"show_school_profile.php?action=1&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-danger\">Delete</button></a></div>"], ';
	else
		$series_entries .= '["' . $row["id"] . '", "' . $row["contact_first_name"] . '", "' . $row["contact_surname"] . '", "' . $row["email"] . '", "' . $row["mobile"] . '", "' . $row["school_name"] . '", "' . $row["address1"] . '", "' . $row["address2"] . '", "' . $row["address3"] . '", "' . $row["district"] . '", "' . $row["verified"] . '", "' . $row["online"] . '", "<div style=\"width:120px;\"><a href=\"show_school_profile.php?action=0&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-success\">Edit</button></a> <a href=\"show_school_profile.php?action=1&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-danger\">Delete</button></a></div>"]';
	$count++;
}
$series_entries .= ' ]}'; 

$file_array_data =  "arrays_schools.txt";
$fp = fopen($file_array_data,'w');
$write = fwrite($fp,$series_entries);
$fp = fclose($fp);
?>