<?php
include "../../global_paths.php";
include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_login_check.php";

?>
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_header.php"; ?>
    <title>Upload Logo</title>
    <style>
    form 
	{ 
	  display: block; 
	  margin: 20px auto; 
	  background: #eee; 
	  border-radius: 10px; 
	  padding: 15px 
	}
	
	.progress 
	{
	  display:none; 
	  position:relative; 
	  width:400px; 
	  border: 1px solid #ddd; 
	  padding: 1px; 
	  border-radius: 3px; 
	}
	.bar 
	{ 
	  background-color: #B4F5B4; 
	  width:0%; 
	  height:20px; 
	  border-radius: 3px; 
	}
	.percent 
	{ 
	  position:absolute; 
	  display:inline-block; 
	  top:3px; 
	  left:48%; 
	}
    </style>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery.form.js"></script>
    <script>
	function upload_image() 
	{
		var bar = $('#bar1');
		var percent = $('#percent1');
		
		$('#myForm').ajaxForm({
			beforeSubmit: function() {
				document.getElementById("progress_div").style.display="block";
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			success: function() {
				var percentVal = '100%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			complete: function(xhr) {
				if(xhr.responseText)
				{
					document.getElementById("output_image").innerHTML=xhr.responseText;
					document.getElementById("logo_image_current").style.display='none';
				}
			}
		}); 
	}
</script> 
  </head>

  <body>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_admin_menu.php"; ?>
        
        <div id="fullscreen_block" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">Upload Logo</h2>

        <section>
        
			<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/admin_tool/insert_logo_image.php"; ?>
			<div style="width:100%;">
				<form action="upload.php" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
				  <input type="file" id="upload_file" name="upload_file" /><br />
				  <input type="submit" name='submit_image' value="Upload Logo" onclick='upload_image();'/>
				</form>
				<div class='progress' id="progress_div">
					<div class='bar' id='bar1'></div>
					<div class='percent' id='percent1'>0%</div>
				</div>
				<div id='output_image'>
				</div>
				
			</div>
							
		</section>
        </div>
      </div>
    </div>
  </body>
</html>
