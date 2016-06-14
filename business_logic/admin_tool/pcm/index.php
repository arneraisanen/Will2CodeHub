
<!DOCTYPE html>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


<link rel="stylesheet" href="dependencies/bootstrap-3.2.0/css/bootstrap.min.css"> <!--for bootstrap theme-->    
 
<script src="dependencies/jquery/jquery-1.11.1.min.js"></script>        
              <script src="dependencies/bootstrap-3.2.0/js/bootstrap.min.js"></script><!--for bootstrap theme-->    
              <script src="dependencies/jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>
              
              <script src="jquery.picture.cut/src/jquery.picture.cut.js"></script> 

    
    <script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$("#container_image").PictureCut({
        InputOfImageDirectory       : "image",
        PluginFolderOnServer        : "/src/jquery.picture.cut/",
        FolderOnServer              : "/",
        EnableCrop                  : true,
        CropWindowStyle             : "Bootstrap"
    });
	</script>    <title>Edit Profile Image 1</title>
  </head>

  <body>
	
	<div id="container_image"></div>  



  </body>
</html>
