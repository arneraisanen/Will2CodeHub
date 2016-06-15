<?php
session_start();
include "../../global_paths.php";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$company_id = $_SESSION['company_id'];
$salesperson_id = $_SESSION['id'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

$client_id= $_POST['client_id'];

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
	$proposal_new_id = $row2["current"] + 1;
}

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name1, name2, address, city, state, zip, phone1, phone2, email, email2, date, rental, install, best, better, good, notes FROM client WHERE id='$client_id'");
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
	while($row = $STH->fetch())
	{
		$name1= $row["name1"];
		$name2= $row["name2"];
		$address= $row["address"];
		$city=$row["city"];
		$state= $row['state'];
		$phone1= $row['phone1'];
		$phone2= $row['phone2'];
		$email= $row['email'];
		$date=$row['date'];
		$rental= $row['rental'];
		$install= $row['install'];
		$zip= $row['zip'];
		$email2= $row['email2'];
		$notes= $row['notes'];
	}
}

try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

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
	$STH2->bindParam(':proposal_id', $proposal_new_id);
	$STH2->bindParam(':notes', $notes);
	$STH2->execute();

	$_SESSION['client_id'] = $DBH2->lastInsertId();
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details." . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$client_id = $_SESSION['client_id'];
$name1 = $_SESSION['client_id'] . '_' . $proposal_new_id;
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

$_SESSION['proposal_id'] = $proposal_new_id;

echo "Existing client chosen, but with a new proposal";

?>