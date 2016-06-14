<?php include "../../../global_paths.php";
session_start();

$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
$project_name= $_SESSION['project'];
$type_flag= $_POST['type_flag'];

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, introtext FROM demo_feature_csr_projects WHERE project_name = '$project_name'");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details:" . $e->getMessage();
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

while($row = $STH->fetch())
{
	$introtext = $row["introtext"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>

<style type="text/css">
#hideoverflow { overflow: hidden; }
#outer { position: relative; left: 50%; float: left; }
#inner { position: relative; left: -50%; float: left; }
</style>
<title>CSR Scripts: <?php echo $_SESSION['project']; ?></title>
</head>
<body>
<div id="wrapperDiv">
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu_csr.php"; ?>

	<div class="requirment-techers">
		<div class="container">
			<div class="requirment-techers-you">
				<p style="font-size: 24px;">
					CSR Scripting System licensed by ARBCO LLC Coaching and Training Battle Ground WA 98604
				</p>
			</div>
		</div>
	</div>
	<div class="options-home">
		<div class="container">
			<div class="row">
				<div class="jumbotron"  style="width:600px; margin:auto;background-color:#fff;">
					<img style="float:left;" src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/images/logo.png">
					<div style="float:left; margin-left: 30px; font-size: 20px; margin-top: 30px;">
						CSR Scripting Software Licensed To:<br />
						
						<div id="hideoverflow" style=" font-size: 24px; margin: 30px 0px;">
						    <div id="outer">
						        <div id="inner">
						            <div style="font-size: 34px;"><?php echo $_SESSION['fullname'] ?></div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="jumbotron" id="project_scripts_display_box" style="width:600px; margin:auto;background-color:#fff;">
				  	<div style="width:470px; margin:30px auto; font-size: 24px; text-align:center;"><?php echo $introtext ?></div>
				</div>
			</div>
			
			<div class="row">
				<div class="jumbotron" id="project_scripts_display_box" style="width:600px; margin:auto;background-color:#fff;">
				  	<div style="width:470px; margin:30px auto; font-size: 24px;">Please choose one of the following options</div>
				  	<a href="project_scripts.php?sub_project=service"><button style="float: left; height:100px; width: 200px;" class="btn btn-primary btn-lg" id="registerBtn" type="button">Service</button></a>
				  	<a href="project_scripts.php?sub_project=sales"><button style="float: right; height:100px; width: 200px;" class="btn btn-primary btn-lg" id="registerBtn" type="button">Sales</button></a>
				</div>
			</div>
			
			<div class="row">
				<div class="jumbotron" style="width:600px; margin:auto;background-color:#fff;">
				  	<a href="project_scripts.php?sub_project=complaint"><button style="float: left; height:100px; width: 200px;" class="btn btn-primary btn-lg" id="registerBtn" type="button">Complaint</button></a>
				  	<a href="project_scripts.php?sub_project=other"><button style="float: right; height:100px; width: 200px;" class="btn btn-primary btn-lg" id="registerBtn" type="button">All Other</button></a> 
				</div>
			</div>
			
			<div class="row">
				<div class="jumbotron" style="width:600px; margin:auto;background-color:#fff;">
					<div id="hideoverflow">
					    <div id="outer">
					        <div id="inner">
					            <div style="font-size: 34px;"><?php echo $_SESSION['project']; ?></div>
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/images/call_centre.jpg">
		<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>
		
</div>
</body>
</html>