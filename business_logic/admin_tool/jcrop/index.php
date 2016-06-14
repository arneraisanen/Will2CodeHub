<?php
$id = $_GET["id"]; 
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery File Upload Example</title>
  
  <!-- Bootstrap CSS Toolkit styles -->
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
 
</head>

<body>
<div class="container">  
  <!-- Button to select & upload files -->
  <span class="btn btn-success fileinput-button">
    <span>Select files...</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files[]">
  </span>
  
  
  <!-- The global progress bar -->
  <p>Upload progress</p>
  <div id="progress" class="progress progress-success progress-striped">
    <div class="bar"></div>
  </div>
  
  
  
  <!-- The list of files uploaded -->
  <p>Files uploaded:</p>
  <ul id="files"></ul>
  
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  	<iframe id="image_crop_iframe" src="demos/crop.php?id=<?php echo $id; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="700px"></iframe>
  </div>
  
  <!-- Load jQuery and the necessary widget JS files to enable file upload -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="js/jquery.ui.widget.js"></script>
  <script src="js/jquery.iframe-transport.js"></script>
  <script src="js/jquery.fileupload.js"></script>
  
  
  
  
  <!-- JavaScript used to call the fileupload widget to upload files -->
  <script>
    // When the server is ready...
    $(function () {
        'use strict';
        
        // Define the url to send the image data to
        var url = 'files.php';
        
        // Call the fileupload widget and set some parameters
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                // Add each uploaded file name to the #files list
                $.each(data.result.files, function (index, file) {
                    $('<li/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                // Update the progress bar while files are being uploaded
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
                if (progress == 100)
                {
                	var rand = Math.floor((Math.random()*1000000)+1);
                	var iframe = document.getElementById('image_crop_iframe');
                	iframe.src = "demos/crop.php?id=<?php echo $id; ?>&uid="+rand;
                	//document.getElementById('profile_image_icon').src = "../../../profile_images/<?php echo $id; ?>/thumbnail/<?php echo $id; ?>.jpg?random="+new Date().getTime();
                }
            }
        });
    });
    
  </script>
</div>
</body> 
</html>