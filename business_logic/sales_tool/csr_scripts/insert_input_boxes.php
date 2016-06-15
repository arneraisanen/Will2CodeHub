<?php
include "../../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, label, input_box, short_code FROM demo_feature_csr_scripts_inputs");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$script_text = '<hr><br /><table cellspacing="10" cellpadding="10">';
				
while($row = $STH->fetch())
{
	$script_text .= '<tr style="display:none;" id="' . $row["short_code"] . '">
						<td style="width: 200px; text-align: left; padding-right: 20px;">' . $row["label"] . '</td>
						<td>' . $row["input_box"] . '</td>
					</tr>';
}
$script_text .= '<tr><td colspan="2"><button style="float: right;" class="btn btn-primary btn-lg" id="registerBtn" type="button" onclick="csr_projects_gen_report();">Generate Report</button></td></tr>
				<tr><td style="text-align: right; padding-top: 20px;" id="report_pdf_link" colspan="2"></td></tr>
				</table>';

echo $script_text;
?>