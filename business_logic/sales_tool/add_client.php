<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$salesperson_id = $_SESSION['id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$name1= $_POST['field_1_add'];
$name2= $_POST['field_2_add'];
$address= $_POST['field_3_add'];
$city= $_POST['field_4_add'];
$state= $_POST['field_5_add'];
$phone1= $_POST['field_6_add'];
$phone2= $_POST['field_7_add'];
$email= $_POST['field_8_add'];
$date= date("Y-m-d", strtotime(str_replace('-', '/', $_POST['field_9_add'])));
$rental= $_POST['field_10_add'];
$install= date("Y-m-d", strtotime(str_replace('-', '/', $_POST['field_11_add'])));
$zip= $_POST['field_12_add'];
$email2= $_POST['field_13_add'];
$notes= $_POST['field_14_add'];
$type_flag= $_POST['type_flag'];
$field_1_matrix= $_POST['field_1_matrix'];
$field_2_matrix= $_POST['field_2_matrix'];
$field_3_matrix= $_POST['field_3_matrix'];
$field_4_matrix= $_POST['field_4_matrix'];
$field_5_matrix= $_POST['field_5_matrix'];


try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, proposal_id FROM client WHERE name1='$name1' AND company_id='$company_id' AND salesperson_id='$salesperson_id'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


if ($STH->rowCount() > 0)
{
	$client_id = '';
	
	
	while($row = $STH->fetch())
	{
		$_SESSION['client_id'] = $row["id"];
		$_SESSION['proposal_id'] = $row["proposal_id"];
		$client_id = $row["id"];
	}
	
	if ($type_flag == 0)
	{
		try
		{
			$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
			$STH2 = $DBH2->prepare("DELETE FROM client WHERE id=:client_id");
			$STH2->bindParam(':client_id', $client_id);
			$STH2->execute();
		}
		catch(PDOException $e)
		{
			echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
			exit;
		}
		
		unset($_SESSION['proposal_id']);
		unset($_SESSION['client_id']);
	}
	else 
	{
		if ($field_5_matrix == 1)
		{
			try
			{
				$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
				$STH2 = $DBH2->prepare("UPDATE client SET name1 = :name1, name2 = :name2, address = :address, city = :city, state = :state, zip = :zip, phone1 = :phone1, phone2 = :phone2, email = :email, email2 = :email2, date = :date, rental = :rental, install = :install, notes = :notes, overhead = :field_1_matrix, profit_margin = :field_2_matrix, admin_cost = :field_3_matrix, sub_con_markup = :field_4_matrix, salesperson_edit_matrix = :field_5_matrix WHERE id=:client_id");
			
				$STH2->bindParam(':name1', $name1);
				$STH2->bindParam(':name2', $name2);
				$STH2->bindParam(':address', $address);
				$STH2->bindParam(':city', $city);
				$STH2->bindParam(':state', $state);
				$STH2->bindParam(':zip', $zip);
				$STH2->bindParam(':phone1', $phone1);
				$STH2->bindParam(':phone2', $phone2);
				$STH2->bindParam(':email', $email);
				$STH2->bindParam(':email2', $email2);
				$STH2->bindParam(':date', $date);
				$STH2->bindParam(':rental', $rental);
				$STH2->bindParam(':install', $install);
				$STH2->bindParam(':client_id', $client_id);
				$STH2->bindParam(':notes', $notes);
				$STH2->bindParam(':field_1_matrix', $field_1_matrix);
				$STH2->bindParam(':field_2_matrix', $field_2_matrix);
				$STH2->bindParam(':field_3_matrix', $field_3_matrix);
				$STH2->bindParam(':field_4_matrix', $field_4_matrix);
				$STH2->bindParam(':field_5_matrix', $field_5_matrix);
				$STH2->execute();
			}
			catch(PDOException $e)
			{
				echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
				file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
				exit;
			}
		}
		else 
		{
			try
			{
				$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					
				$STH2 = $DBH2->prepare("UPDATE client SET name1 = :name1, name2 = :name2, address = :address, city = :city, state = :state, zip = :zip, phone1 = :phone1, phone2 = :phone2, email = :email, email2 = :email2, date = :date, rental = :rental, install = :install, notes = :notes WHERE id=:client_id");
					
				$STH2->bindParam(':name1', $name1);
				$STH2->bindParam(':name2', $name2);
				$STH2->bindParam(':address', $address);
				$STH2->bindParam(':city', $city);
				$STH2->bindParam(':state', $state);
				$STH2->bindParam(':zip', $zip);
				$STH2->bindParam(':phone1', $phone1);
				$STH2->bindParam(':phone2', $phone2);
				$STH2->bindParam(':email', $email);
				$STH2->bindParam(':email2', $email2);
				$STH2->bindParam(':date', $date);
				$STH2->bindParam(':rental', $rental);
				$STH2->bindParam(':install', $install);
				$STH2->bindParam(':client_id', $client_id);
				$STH2->bindParam(':notes', $notes);
				$STH2->execute();
			}
			catch(PDOException $e)
			{
				echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
				file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
				exit;
			}
		}
	}
}
else
{
	/*  now we need to update the proposal ID's */
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("SELECT current FROM proposal_ids WHERE id='1'");
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
		$current_tmp = $row2["current"] + 1;
		$id_tmp = 1;
	}
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("UPDATE proposal_ids SET current = :current WHERE id=:id");
	
		$STH2->bindParam(':id', $id_tmp);
		$STH2->bindParam(':current', $current_tmp);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	$_SESSION['proposal_id'] = $current_tmp;
	
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		if ($field_5_matrix == 1)
		{
			$STH2 = $DBH2->prepare("INSERT INTO client ( name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, company_id, salesperson_id, proposal_id, notes, overhead, profit_margin, admin_cost, sub_con_markup, salesperson_edit_matrix ) values ( :name1, :name2, :address, :city, :state, :zip, :phone1, :phone2, :email, :email2, :date, :rental, :install, :company_id, :salesperson_id, :proposal_id, :notes, :field_1_matrix, :field_2_matrix, :field_3_matrix, :field_4_matrix, :field_5_matrix)");
	
			$STH2->bindParam(':name1', $name1);
			$STH2->bindParam(':name2', $name2);
			$STH2->bindParam(':address', $address);
			$STH2->bindParam(':city', $city);
			$STH2->bindParam(':state', $state);
			$STH2->bindParam(':zip', $zip);
			$STH2->bindParam(':phone1', $phone1);
			$STH2->bindParam(':phone2', $phone2);
			$STH2->bindParam(':email', $email);
			$STH2->bindParam(':email2', $email2);
			$STH2->bindParam(':date', $date);
			$STH2->bindParam(':rental', $rental);
			$STH2->bindParam(':install', $install);
			$STH2->bindParam(':company_id', $company_id);
			$STH2->bindParam(':salesperson_id', $salesperson_id);
			$STH2->bindParam(':proposal_id', $current_tmp);
			$STH2->bindParam(':notes', $notes);
			$STH2->bindParam(':field_1_matrix', $field_1_matrix);
			$STH2->bindParam(':field_2_matrix', $field_2_matrix);
			$STH2->bindParam(':field_3_matrix', $field_3_matrix);
			$STH2->bindParam(':field_4_matrix', $field_4_matrix);
			$STH2->bindParam(':field_5_matrix', $field_5_matrix);
			$STH2->execute();
			
			$_SESSION['client_id'] = $DBH2->lastInsertId();
		}
		else
		{
			$STH2 = $DBH2->prepare("INSERT INTO client ( name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, company_id, salesperson_id, proposal_id, notes) values ( :name1, :name2, :address, :city, :state, :zip, :phone1, :phone2, :email, :email2, :date, :rental, :install, :company_id, :salesperson_id, :proposal_id, :notes)");
			
			$STH2->bindParam(':name1', $name1);
			$STH2->bindParam(':name2', $name2);
			$STH2->bindParam(':address', $address);
			$STH2->bindParam(':city', $city);
			$STH2->bindParam(':state', $state);
			$STH2->bindParam(':zip', $zip);
			$STH2->bindParam(':phone1', $phone1);
			$STH2->bindParam(':phone2', $phone2);
			$STH2->bindParam(':email', $email);
			$STH2->bindParam(':email2', $email2);
			$STH2->bindParam(':date', $date);
			$STH2->bindParam(':rental', $rental);
			$STH2->bindParam(':install', $install);
			$STH2->bindParam(':company_id', $company_id);
			$STH2->bindParam(':salesperson_id', $salesperson_id);
			$STH2->bindParam(':proposal_id', $current_tmp);
			$STH2->bindParam(':notes', $notes);
			$STH2->execute();
				
			$_SESSION['client_id'] = $DBH2->lastInsertId();
		}
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
	
	$client_id = $_SESSION['client_id'];
	$name1 = $_SESSION['client_id'] . '_' . $current_tmp;
	try
	{
		$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH2 = $DBH2->prepare("UPDATE client SET name1 = :name1 WHERE id=:client_id");
	
		$STH2->bindParam(':name1', $name1);
		$STH2->bindParam(':client_id', $client_id);
		$STH2->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}

if ($type_flag == 0)
	echo 'Client Deleted';
else
	echo "The entry was successfully added to the database";

?>