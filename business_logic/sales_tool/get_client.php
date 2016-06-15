<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$company_id = $_SESSION['company_id'];

$salesperson_id = $_SESSION['id'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT `id`, `salesperson_edit_matrix`, `overhead`, `profit_margin`, `admin_cost`, `sub_con_markup` FROM `company` WHERE company_id='$company_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}
while($row = $STH->fetch())
{
	$salesperson_edit_matrix = $row['salesperson_edit_matrix'];

	$overhead = $row['overhead'];
	$profit_margin = $row['profit_margin'];
	$admin_cost = $row['admin_cost'];
	$sub_con_markup = $row['sub_con_markup'];
}


if ($salesperson_edit_matrix)
	$matrix_edit = '<a href="javascript:void(0)" onclick="toggle_edit_matrix();">Edit Company Markup</a><div style="display:none;" id="show_matrix_box"><br /><br />
				<div style="display:none;">Company Overhead <input style="width:25%;" id="field_1_matrix" name="field_1_matrix" class="form-control" data-trigger="focus" type="text" value="' . $overhead . '"/></div>
				Desired Profit Margin <input style="width:25%;" id="field_2_matrix" name="field_2_matrix" class="form-control" data-trigger="focus" type="text" value="' . $profit_margin . '"/>
				<div style="display:none;">Administration Cost <input style="width:25%;" id="field_3_matrix" name="field_3_matrix" class="form-control" data-trigger="focus" type="text" value="' . $admin_cost . '"/></div>
				Sub-contractor Mark Up <input style="width:25%;" id="field_4_matrix" name="field_4_matrix" class="form-control" data-trigger="focus" type="text" value="' . $sub_con_markup . '"/>
				</div>';
else
	$matrix_edit = '';

if (isset($_SESSION['client_id']))
{
	$client_id = $_SESSION['client_id'];
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT id, name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good, notes, proposal_id, salesperson_edit_matrix, overhead, profit_margin, admin_cost, sub_con_markup FROM client WHERE id='$client_id'");
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
	while($row = $STH->fetch())
	{  
		$_SESSION['proposal_id'] = $row['proposal_id'];
		
		$salesperson_edit_matrix = $row['salesperson_edit_matrix'];
		$overhead = $row['overhead'];
		$profit_margin = $row['profit_margin'];
		$admin_cost = $row['admin_cost'];
		$sub_con_markup = $row['sub_con_markup'];
		
		if ($salesperson_edit_matrix)
			$matrix_edit = '<a href="javascript:void(0)" onclick="toggle_edit_matrix();">Edit Company Markup</a><div style="display:none;" id="show_matrix_box"><br /><br />
				<div style="display:none;">Company Overhead <input style="width:25%;" id="field_1_matrix" name="field_1_matrix" class="form-control" data-trigger="focus" type="text" value="' . $overhead . '"/></div>
				Desired Profit Margin <input style="width:25%;" id="field_2_matrix" name="field_2_matrix" class="form-control" data-trigger="focus" type="text" value="' . $profit_margin . '"/>
				<div style="display:none;">Administration Cost <input style="width:25%;" id="field_3_matrix" name="field_3_matrix" class="form-control" data-trigger="focus" type="text" value="' . $admin_cost . '"/></div>
				Sub-contractor Mark Up <input style="width:25%;" id="field_4_matrix" name="field_4_matrix" class="form-control" data-trigger="focus" type="text" value="' . $sub_con_markup . '"/>
				</div>';
		
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
		
		$rental_home1 = '';
		$rental_home2 = '';
		if ($row["rental"])
			$rental_home1 = 'checked';
		else
			$rental_home2 = 'checked';
		
		$client_date_formatted =  date("m-d-Y", strtotime($row["date"]));
		$install_date_formatted =  date("m-d-Y", strtotime($row["install"]));
						
		$series_entries = '
		<div style="float:right;">
			Notes <textarea rows="20" cols="50" id="field_14_add" name="field_14_add" class="form-control" data-trigger="focus" type="text">' . $row["notes"] . '</textarea>
			<br /><br />' . $matrix_edit . '
		</div>
		<div style="left; width:40%;">
			Proposal ID (Read Only) <input style="background-color: #fff;" READONLY id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value="' . $row["name1"] . '"/>
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
					<div id="field_9_add">' . $client_date_formatted . '</div>
					<input id="dob" name="dateOfBirth" type="hidden" value="' . $client_date_formatted . '"/>
				</div>
		
			Rental Home <div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio1" ' . $rental_home1 . '>Yes</label></div>
						<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio2" ' . $rental_home2 . '>No</label></div>
			Desired Install 
				<div class="date-pic">
					<div id="field_11_add">' . $install_date_formatted . '</div>
					<input id="dob2" name="dateOfBirth2" type="hidden" value="' . $install_date_formatted . '"/>
				</div>
		</div>';
	}
	
	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT id, name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good, notes FROM client WHERE company_id='$company_id' AND salesperson_id='$salesperson_id'");
		$STH->execute();
	
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	$client_entries = '';
	if ($STH->rowCount() > 0)
	{
		$client_entries = '<div style="margin-bottom: 70px;">Existing Client<select id="client_proposal_id" onchange="get_client_proposal_details();" class="form-control" data-trigger="focus"><option value=""></option>';
	
		while($row = $STH->fetch())
		{
			$client_entries .= '<option value="' . $row["id"] . '">(' . $row["name1"] . ') ' . $row["name2"] . '</option>';
		}
	
		$client_entries .= '</select><button id="registerBtn" type="button" onclick="choose_client();">New Proposal for Existing Client</button></div><div style="margin:30px 0px;"></div>';
	}
}
else 
{
	try 
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("SELECT id, name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good, notes FROM client WHERE company_id='$company_id' AND salesperson_id='$salesperson_id'");
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
	$state_var = '<select id="field_5_add" name="field_5_add" class="form-control" data-trigger="focus">
		<option value=""></option>
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
	
	
	$series_entries = '
	<div style="float:right;">
		Notes <textarea rows="20" cols="50" id="field_14_add" name="field_14_add" class="form-control" data-trigger="focus" type="text"></textarea>
		<br /><br />' . $matrix_edit . '
	</div>
	<div style="left; width:40%;">
		Proposal ID (Read Only) <input style="background-color: #fff;" READONLY id="field_1_add" name="field_1_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Name <input id="field_2_add" name="field_2_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Location <input id="field_3_add" name="field_3_add" class="form-control" data-trigger="focus" type="text" value=""/>
		City <input id="field_4_add" name="field_4_add" class="form-control" data-trigger="focus" type="text" value=""/>
		State ' . $state_var . '
		Zip <input id="field_12_add" name="field_12_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Best Phone <input id="field_6_add" name="field_6_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Second Best Phone <input id="field_7_add" name="field_7_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Best Email <input id="field_8_add" name="field_8_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Second Best Email <input id="field_13_add" name="field_13_add" class="form-control" data-trigger="focus" type="text" value=""/>
		Date <div class="date-pic">
				<div id="field_9_add"> </div>
				<input id="dob" name="dateOfBirth" type="hidden" value=""/>
			</div>
		Rental Home <div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio1">Yes</label></div>
					<div class="radio"><label class="radio-inline"><input type="radio" name="optradio" id="optradio2" checked>No</label></div>
		Desired Install <div class="date-pic">
			<div id="field_11_add"> </div>
			<input id="dob2" name="dateOfBirth2" type="hidden" value=""/>
		</div>
	</div>';
	
	
	$client_entries = '';
	if ($STH->rowCount() > 0)
	{ 
		$client_entries = '<div style="margin-bottom: 70px;">Existing Client<select id="client_proposal_id" onchange="get_client_proposal_details();" class="form-control" data-trigger="focus"><option value=""></option>';
		
		while($row = $STH->fetch())
		{  
			$client_entries .= '<option value="' . $row["id"] . '">(' . $row["name1"] . ') ' . $row["name2"] . '</option>';
		}
	
		$client_entries .= '</select><button id="registerBtn" type="button" onclick="choose_client();">New Proposal for Existing Client</button></div><div style="margin:30px 0px;"></div>';
	}
}

$DBH=null;
echo $client_entries . $series_entries;
?>