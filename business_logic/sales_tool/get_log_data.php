<?php
require_once '../admin/db/db_manager.php';	

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, firstname, surname, gender, dob, email, mobile, password, subject, fresher, salary, experience, state, preferred_state, education, address1, address2, address3, pincode, verified, online FROM user_details ORDER BY id ASC");
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
		$series_entries .= '["' . $row["id"] . '", "' . $row["firstname"] . '", "' . $row["surname"] . '", "' . $row["email"] . '", "' . $row["mobile"] . '", "' . $row["subject"] . '", "' . $row["address1"] . '", "' . $row["address2"] . '", "' . $row["address3"] . '", "' . $row["state"] . '", "' . $row["verified"] . '", "' . $row["online"] . '", "<div style=\"width:120px;\"><a href=\"show_professional_profile.php?action=0&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-success\">Edit</button></a> <a href=\"show_professional_profile.php?action=1&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-danger\">Delete</button></a></div>"], ';
	else
		$series_entries .= '["' . $row["id"] . '", "' . $row["firstname"] . '", "' . $row["surname"] . '", "' . $row["email"] . '", "' . $row["mobile"] . '", "' . $row["subject"] . '", "' . $row["address1"] . '", "' . $row["address2"] . '", "' . $row["address3"] . '", "' . $row["state"] . '", "' . $row["verified"] . '", "' . $row["online"] . '", "<div style=\"width:120px;\"><a href=\"show_professional_profile.php?action=0&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-success\">Edit</button></a> <a href=\"show_professional_profile.php?action=1&id=' . $row["id"] . '\"><button type=\"button\" class=\"btn btn-sm btn-danger\">Delete</button></a></div>"]';
	$count++;
}
$series_entries .= ' ]}'; 

$file_array_data =  "arrays.txt";
$fp = fopen($file_array_data,'w');
$write = fwrite($fp,$series_entries);
$fp = fclose($fp);
?>