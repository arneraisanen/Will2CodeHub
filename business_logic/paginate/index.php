<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_meta_into_header.php"; ?>
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_css_and_js_into_header.php"; ?>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
    <style>
            .header{
                position:absolute;
                top:0px;
                left:0px;
                width:100%;
                height:80px;            
            }
            .header h1{
                color:#fff;
                font-size: 38px;
                margin:0px 0px 0px 30px;
                font-weight:100;
                line-height:80px;
                padding:0px;
            }
            .footer{
                width:100%;
                margin:10px 0px 5px 0px;
            }
            a img{
                border:none;
                outline:none;
            }
            .content{
                margin-top:100px;
                padding:0px;
                bottom:0px;
            }
            .about{
                width:100%;
                height:400px;
                background:transparent url(about.png) repeat-x top left;
                border-top:2px solid #ccc;
                border-bottom:2px solid #000;
            }
            .about .text{
                width:16%;
                margin:5px 2% 10px 2%;
                height:380px;
                float:left;
                color:#FCFEF3;
                font-size: 16px;
                text-align:justify;
                letter-spacing:0px;
            }
            .about .text h1{
                border-bottom: 1px dashed #ccc;
                color:#fff;
            }
            .demo{
                width:580px;
                padding:10px;
                margin:10px auto;
                border: 1px solid #fff;
                background-color:#f7f7f7;
            }
			.pagedemo{
				border: 1px solid #CCC;
				width:310px;
				margin:2px;
                padding:50px 10px;
                text-align:center;
				background-color:white;	
			}
        </style>
  </head>

  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_top_menu.php"; ?>


    <div class="carousel-block-position">
		<div class="carousel-caption-position">
            <div class="carousel-caption" style="top:100px; height: 300px;">
              <h1>Join Our Database</h1>
              <p>Fill out the form below to add your details/practice to our teachers database.<br />
              Once completed, an email will be sent to you for confirmation that your details have been submitted.  When reviewed, you will receive another email with a link to your public listing.
              </p>
              </div>
		</div>
	</div>



    <div class="container marketing" style="clear:both;">
	<div style="margin-bottom: 50px; width: 100%; text-align: right;"><a href="javascript:void(0)" onclick="search_results_update(1,'teacher', 1);">List mode</a> | <a href="javascript:void(0)" onclick="search_results_update(1,'teacher', 2);">Thumbnail mode</a></div>
		<div class="table-responsive">
            <table class="table table-striped" id="search_results_data">
              	<?php $search_type="teacher"; include "get_search_results.php"; ?>
              </tbody>
            </table>
          </div>
	
		<div class="container">
				<div class="demo">
					<div style="">  
	                	<div id="search_results">                   
	                	</div>
	                </div>
	            </div>
		</div>


      <?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer.php"; ?>

    </div><!-- /.container -->
    
	<?php include $_SERVER['DOCUMENT_ROOT']."/business_logic/process/insert_footer_stats.php"; ?>
	<script type="text/javascript" src="jquery-1.3.2.js"></script>
	<script src="jquery.paginate.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			$("#search_results").paginate({
				count 		: <?php echo $total_entries; ?>,
				start 		: 1,
				display     : 10,
				border					: false,
				text_color  			: '#888',
				background_color    	: '#EEE',	
				text_hover_color  		: 'black',
				background_hover_color	: '#CFCFCF',
				onChange     			: function(page){
											search_results_update(page,"teacher");
										  }
			});
		});
		</script>
  </body>
</html>


