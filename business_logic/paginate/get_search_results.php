<?php
require_once '../admin/db/db_manager.php';	
if ( isset( $_POST["search_type"] ) )
	$search_type = $_POST["search_type"];

if ( isset( $_POST["display_type"] ) )
	$display_type = $_POST["display_type"];
else 
	$display_type = 1;

if ( isset( $_POST["page_number"] ) )
	$start_index = $_POST["page_number"];
else 
	$start_index = 1;

$start_index = ($start_index - 1)*10;
$end_index = 10;
$limit_str = "LIMIT " . $start_index . ", " . $end_index;


if ($search_type == "teacher")
{
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
	
	$series_entries = '';
	$count = $start_index + 1;
	$total_entries = ceil($STH->rowCount()/10);
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT id, firstname, surname, gender, dob, email, mobile, password, subject, fresher, salary, experience, state, preferred_state, education, address1, address2, address3, pincode, verified, online FROM user_details ORDER BY id ASC " . $limit_str);
		$STH->execute();
	
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	if ($display_type == 1)
	{
		$series_entries = '<thead>
              			 <tr>
                  			<th>#</th>
                  			<th>Ref</th>
                  			<th>Name</th>
                  			<th>Age</th>
                  			<th>District</th>
                  			<th>Subject</th>
                  			<th>Experience</th>
                  			<th>Expected Salary</th>
                  			<th>View</th>
                		</tr>
              		</thead>
              		<tbody>';
	}
	else
	{
		$series_entries = '<tbody>';
	}
	
	while($row = $STH->fetch())
	{
		$ref_num = strtoupper( substr($row["subject"], 0, 3) ) . str_pad($row["id"], 7, '0', STR_PAD_LEFT);
		
		$doc_root = $_SERVER['DOCUMENT_ROOT'];
		$website_root = 'http://'. $_SERVER['SERVER_NAME'];
		$profile_image = $website_root . '/profile_images/' . $id . '.png';
		$full_path_to_profile_image = $doc_root . '/profile_images/' . $id . '.png';
		
		if (!file_exists($full_path_to_profile_image)) {
			$profile_image = $website_root . '/profile_images/default_profile.jpg';
		}
		$age = floor((time() - strtotime($row["dob"])) / 31556926);
		
		if ($display_type == 1)
		{
			$series_entries .= '<tr><td>' . $count . '</td>';
			$series_entries .= '<td>' . $ref_num . '</td>';
			$series_entries .= '<td>' . $row["firstname"] . ' ' . $row["surname"] . '</td>';
			$series_entries .= '<td>' . $age . '</td>';
			$series_entries .= '<td>' . $row["state"] . '</td>';
			$series_entries .= '<td>' . $row["subject"] . '</td>';
			$series_entries .= '<td>' . $row["experience"] . '</td>';
			$series_entries .= '<td>' . $row["salary"] . '</td>';
			$series_entries .= '<td><a href="../user_profile_view.php?id=' . $row["id"] . '">View Profile</a></td></tr>';
			$count++;
		}
		else
		{
			$series_entries .= '<tr><td><img src="' . $profile_image . '" /></td>';
			
			$series_entries .= '<td><table>';
			$series_entries .= '<tr><td>Ref</td><td>' . $ref_num . '</td></tr>';
			$series_entries .= '<tr><td>Name</td><td>' . $row["firstname"] . ' ' . $row["surname"] . '</td></tr>';
			$series_entries .= '<tr><td>Age</td><td>' . $age . '</td></tr>';
			$series_entries .= '<tr><td>Subject</td><td>' . $row["subject"] . '</td></tr>';
			$series_entries .= '</table></td>';
			
			$series_entries .= '<td><table>';
			$series_entries .= '<tr><td>District</td><td>' . $row["subject"] . '</td></tr>';
			$series_entries .= '<tr><td>Experience</td><td>' . $row["experience"] . '</td></tr>';
			$series_entries .= '<tr><td>Salary</td><td>' . $row["salary"] . '</td></tr>';
			$series_entries .= '<tr><td></td><td><a href="../user_profile_view.php?id=' . $row["id"] . '">View Profile</a></td></tr>';
			$series_entries .= '</table></td></tr>';
		}
	}
	
	echo $series_entries;
}
else
{
	;
}

function sendBulkSms() 
{ 
	$strMsg = 'Dear User, this is your validation code for yourteachers.in: 56932. Please login and enter this code.';
	$strPh = "8220899699";
	
	if($strMsg!="" and $strPh!="") 
	{ 
		$strMsg=str_replace(" ","%20",$strMsg); 
		return file_get_contents("http://103.16.101.52:8080/sendsms/bulksms?username=q2h-yourteacher&password=634ads&type=0&dlr=1&destination=91".$strPh."&source=022751&message=".$strMsg);
	}
}

?>