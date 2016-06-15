<?php
$id = $_GET["id"];
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';
try 
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, title, firstname, surname, specialisation, email, phone, mobile, address1, address2, address3, state  FROM doctor_details WHERE verified='1' AND online='1' AND id='$id'");
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
	$id = $row["id"];
	$title = $row["title"];
	$firstname = $row["firstname"];
	$surname = $row["surname"];
	$email = $row["email"];
	$phone = $row["phone"];
	$mobile = $row["mobile"];
	$specialisation = $row["specialisation"];
	$address1 = $row["address1"];
	$address2 = $row["address2"];
	$city = $row["address3"];
	$state = $row["state"];
	$verified = $row["verified"];
	$online = $row["online"];
}

$full_path_to_profile_image = $doc_root . '/profile_images/' . $id . '.png';

if (!file_exists($full_path_to_profile_image))
	$profile_image = $website_root . '/profile_images/default_profile.jpg';
else
	$profile_image = $website_root . '/profile_images/' . $id . '.png';

$profile_display = <<<EOD
		<img style="float:right" src="$profile_image" />
		<div class="registration-form" style="  width: 100%; max-width: 700px; margin-left: 100px;">
		<form style="float:left; margin-right: -100px; margin-bottom: 150px;">
		<div class="row">
		<div class="col-sm-4">
		<label>Email</label>
		</div>
		<div class="col-sm-6">
		<div class="">
		<input style="font-size: 20px;" READONLY value="$email" id="email" name="email" class="school-name" required="required" type="email" value=""/>
		</div>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-4">
		<label>Phone </label>
		</div>
		<div class="col-sm-6">
		<div class="">
		<input style="font-size: 20px;" READONLY value="$phone" id="landlineNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-sm-4">
		<label>Mobile </label>
		</div>
		<div class="col-sm-6">
		<div class="">
		<input style="font-size: 20px;" READONLY value="$mobile" id="mobileNumber" name="mobileNumber" class="school-name" required="required" type="number" value=""/>
		</div>
		</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label>Specialisation </label>
			</div>
			<div class="col-sm-6">
				<div class="" style="height: 56px;">
		
					<input style="font-size: 20px;" READONLY value="$specialisation" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<label>Practice Address</label>
			</div>
			<div class="col-sm-6">
				<div class="">
					<input style="font-size: 20px;" READONLY value="$address1" id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value=""/>
					<input style="font-size: 20px;" READONLY value="$address2" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
					<input style="font-size: 20px;" READONLY value="$city" id="addressLine2" name="addressLine2" class="school-name" type="text" value=""/>
				</div>
			</div>
		</div>
							
		<div class="row">
			<div class="col-sm-4">
				<label>State </label>
			</div>
			<div class="col-sm-6">
				<div class="" style="height: 56px;">
		
					<input style="font-size: 20px;" READONLY id="addressLine1" name="addressLine1" class="school-name" required="required" type="text" value="$state"/>
				</div>
			</div>
		</div>
	</form>
EOD;

require_once 'rating/config.php';
$post_id = $id;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Healthcare Provider Profile</title>
    <link type="text/css" rel="stylesheet" href="rating/css/style.css">
    <link type="text/css" rel="stylesheet" href="rating/css/example.css">
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_search_panel.php"; ?>

    <div class="container marketing" style="clear:both;">

    <hr class="featurette-divider" style="margin: 10px 0 0px 0;">

		<div class="row featurette">
        <div class="col-md-12">
        	<h2 class="featurette-heading"><?php echo $title . ' ' . $firstname . ' ' . $surname ?></h3>
          	<p></p><br />
          	<div class="table-responsive">
          		<?php echo $profile_display ?>
			</div>
			<div class="tuto-cnt">
			<div class="box-result-cnt" style="  float: left;">
            <?php
                $query = mysql_query("SELECT * FROM wcd_rate WHERE id_post='$id'"); 
                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
            ?>
            <h3>The content was rated <strong><?php echo $rate_times; ?></strong> times</h3>
            <h3>The rating is at <strong><?php echo $rate_value; ?></strong></h3>
            <hr>
            <div class="rate-result-cnt">
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>
        </div><!-- /rate-result-cnt -->
		        <div class="rate-ex1-cnt">
		            <div id="1" class="rate-btn-1 rate-btn"></div>
		            <div id="2" class="rate-btn-2 rate-btn"></div>
		            <div id="3" class="rate-btn-3 rate-btn"></div>
		            <div id="4" class="rate-btn-4 rate-btn"></div>
		            <div id="5" class="rate-btn-5 rate-btn"></div>
		        </div>
		    </div>
		    
		    <br><br><br><br><br>
        </div>
      </div>

      <hr class="featurette-divider">
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->
    
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>

  <script>
        // rating script
        $(function(){ 
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });
                            
            $('.rate-btn').click(function(){    
                var therate = $(this).attr('id');
                var dataRate = 'act=rate&post_id=<?php echo $post_id; ?>&rate='+therate; //
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };
                $.ajax({
                    type : "POST",
                    url : "http://www.freeimagedesigns.com/business_logic/rating/ajax.php",
                    data: dataRate,
                    success:function(){}
                });
                
            });
        });
    </script> 
  </body>
</html>