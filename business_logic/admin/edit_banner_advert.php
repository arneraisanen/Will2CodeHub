<?php
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

require_once '../admin/db/db_manager.php';

$action = $_GET["action"];
$id = $_GET["id"];



try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, image, link FROM banner_adverts WHERE id='$id'");
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
if ($action == 0)
{
	while($row = $STH->fetch())
	{
		$id = $row["id"];
		$name = $row["name"];
		$image = $row["image"];
		$link = $row["link"];

		$profile_edit = <<<EOD
			<form id="teacherRegForm" action="" method="post" enctype="multipart/form-data">
			<input type="file" style="visibility: hidden;" name="file">
			<div class="registration-teach">
			<h2>Banner Advert (ID: $id)</h2>
			<div class="registration-form">
			<form id="theform">
			<div class="row">
				<div class="col-sm-6">
					<div class="email-form">
						<label>Name </label>
						<div class="req">
							<input value="$name" id="title" name="title" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
						</div>
					</div>
				</div>
			</div>
					
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>Image</label>
			<div class="req">
			<input value="$image" id="image_url" name="image_url" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			
			<div class="row">
			<div class="col-sm-6">
			<div class="email-form">
			<label>Link</label>
			<div class="req">
			<input value="$link" id="url_link" name="url_link" class="school-name" required="required" data-trigger="focus" type="text" value=""/>
			</div>
			</div>
			</div>
			
			
												
			<div class="cancel-submit">
				<ul>
					<li><a href="#" onclick="location.href='banner_adverts_management.php'">Cancel</a></li>
					<li>
						<button id="registerBtn" type="button" onclick="banner_advert_update($id);">Update</button>
					</li>
				</ul>
			</div>
			<input type="submit" id="submitBtn" style="visibility: hidden;" />
		</form>
EOD;
	}
}
else
{
	$profile_edit = 'Banner advert (ID: ' . $id . ') was deleted<br /><br /><div class="cancel-submit">
				<ul>
					<li><a href="#"  onclick="location.href=\'banner_adverts_management.php\'">Back to Banner Management page</a></li>
				</ul>
			</div>';

	try
	{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
		$STH = $DBH->prepare("DELETE FROM banner_adverts WHERE id = :id");
	
		$STH->bindParam(':id', $id);
		$STH->execute();
	}
	catch(PDOException $e)
	{
		echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		exit;
	}
}
												
?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_header.php"; ?>
    <title>Edit Banner Advert</title>
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <h2 class="sub-header">Edit Banner Advert</h2>

          <section>
			<br /><br />
			
			<?php echo $profile_edit ?>
			<br /><br />
		</section>
        </div>
      </div>
    </div>



  </body>
</html>
