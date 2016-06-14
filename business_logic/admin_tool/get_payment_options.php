<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, payment_type FROM payment_options WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
    echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$payment_entries = '<select onchange="save_payment_options();" class="form-control" id="payment_option_id">
						<option value="">Add Payment Type</option>                         
						<option value="Visa">Visa</option>                         
						<option value="Mastercard">Mastercard</option>                         
						<option value="Diners Club">Diners Club</option>                       
						<option value="Paypal">Paypal</option>                      
						<option value="American Express">American Express</option>                      
						<option value="Solo">Solo</option>                                     
						<option value="Discover">Discover</option>                
						<option value="Check">Check</option>                         
						<option value="Cash">Cash</option>                       
						<option value="E-Check">E-Check</option>
					</select>';


$series_entries = $payment_entries . '<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Payment Type</th>
        <th>Remove</th>
      </tr>
	</thead>
	<tbody>';
$count = 1;
while($row = $STH->fetch())
{
	$series_entries .= '<tr id="payment_type_row_id_' . $row["id"] . '">
        <td>' . $count . '</td>
        <td>' . $row["payment_type"] . '</td>
        <td><button type="button" onclick=remove_payment_type(' . $row["id"] . ') class="btn btn-sm btn-danger">Remove</button></td></tr>';

	$count++;
}
$series_entries .= '

</tbody>
</table>
</div>';

$DBH=null;
echo $series_entries;
?>