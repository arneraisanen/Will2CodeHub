<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$salesperson_id = $_SESSION['id'];

try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good FROM client WHERE company_id='$company_id' AND salesperson_id='$salesperson_id'");
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
$client_entries = '<select id="client_proposal_id" onlcick="populate_client_form();">';
while($row = $STH->fetch())
{
	$client_entries .= '<option value="' . $row["username"] . '">' . $row["firstname"] . ' ' . $row["surname"] . '</option>';
}


$state_var = '<select id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>';

if ($STH->rowCount() == 0)
{
	$series_entries .= '
	Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Name <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Location <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
	City <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
	State ' . $state_var . '
	Zip <input id="field_12_add" name="field_12_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Best Phone <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Second Best Phone <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Best Email <input id="field_8_add" name="field_8_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Second Best Email <input id="field_13_add" name="field_13_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Date <input id="field_9_add" name="field_9_add" class="form-control" data-trigger="focus" type="text" value=""/>
			<div class="date-pic req">
					<div id="dobJqxWidget"> </div>
					<input id="dob" name="dateOfBirth" type="hidden" value=""/>
				</div>
	Rental Home <input id="field_10_add" name="field_10_add" class="form-control" data-trigger="focus" type="text" value=""/>
	Desired Install <input id="field_11_add" name="field_11_add" class="form-control" data-trigger="focus" type="text" value=""/>';
}
if ($STH->rowCount() == 1)
while($row = $STH->fetch())
{  
	$state_var_populates = '<select id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus">
	<option value="' . $row["state"] . '">' . $row["state"] . '</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>';
	
	$series_entries .= '
	Name <input id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["name1"] . '"/>
	Name <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value="' . $row["name2"] . '"/>
	Location <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value="' . $row["address"] . '"/>
	City <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value="' . $row["city"] . '"/>
	State ' . $state_var_populates . '
	Zip <input id="field_12_add" name="field_12_add" class="form-control" data-trigger="focus" type="text" value="' . $row["zip"] . '"/>
	Best Phone <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value="' . $row["phone1"] . '"/>
	Second Best Phone <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value="' . $row["phone2"] . '"/>
	Best Email <input id="field_8_add" name="field_8_add" class="form-control" data-trigger="focus" type="text" value="' . $row["email"] . '"/>
	Second Best Email <input id="field_13_add" name="field_13_add" class="form-control" data-trigger="focus" type="text" value="' . $row["email2"] . '"/>
	Date 
				<div class="date-pic">
					<div id="field_9_add">' . $row["date"] . '</div>
					<input id="dob" name="dateOfBirth" type="hidden" value="' . $row["date"] . '"/>
				</div>


	Rental Home <input id="field_10_add" name="field_10_add" class="form-control" data-trigger="focus" type="text" value="' . $row["rental"] . '"/>
	Desired Install 
				<div class="date-pic">
					<div id="field_11_add">' . $row["install"] . '</div>
					<input id="dob2" name="dateOfBirth2" type="hidden" value="' . $row["install"] . '"/>
				</div>';
}
$client_entries .= '</select>';
$DBH=null;
echo $series_entries;
?>