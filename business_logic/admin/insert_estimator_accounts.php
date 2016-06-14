<?php
include_once "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `company_id`, `reference_number`, `license_type`, `expired`, `expiry_date`, `joined`, `last_payment`, `recurring`, `termination_date` FROM `company_account` WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 183 DAY) ORDER BY expiry_date ASC");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$row_count = $STH->rowCount();

$accounts_summary_text = '<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="padding-left: 0px;">ID</th>
        <th style="padding-left: 0px;">Name</th>
        <th style="padding-left: 0px;">License Type</th>
        <th style="padding-left: 0px;">Expired</th>
        <th style="padding-left: 0px;">Recurring</th>
        <th style="padding-left: 0px;">Expiry Date</th>
      </tr>
	</thead>
	<tbody>';

while($row = $STH->fetch())
{
	$company_id_tmp = $row["company_id"];
	
	try 
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT name, contact_name, phone, email, credit_card_expiration, license_expiration FROM companies WHERE id='$company_id_tmp'");
		$STH2->execute();
	
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) 
	{
	    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
		
	while($row2 = $STH2->fetch())
	{  
		$expired = $row["expired"]?"Yes":"No";
		$recurring = $row["recurring"]?"Yes":"No";
		
		$accounts_summary_text .= '<tr id="account_row_id_' . $row["id"] . '">
		<td>' . $row["company_id"] . '</td>
		<td>' . $row2["name"] . '</td>
		<td>' . $row["license_type"] . '</td>
		<td>' . $expired . '</td>
		<td>' . $recurring . '</td>
		<td>' . $row["expiry_date"] . '</td></tr>';
	}
}

$accounts_summary_text .= '
</tbody>
</table>
</div>';

echo $accounts_summary_text;
?>