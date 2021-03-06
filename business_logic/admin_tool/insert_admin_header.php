<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

ob_start();
include($doc_root."/business_logic/process/insert_css_and_js_into_header.php");
$insert_css_and_js_into_header = ob_get_contents();
ob_end_clean();

$panel = <<<EOD
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="examples/resources/demo.css">
	<link rel="stylesheet" href="color-master/css/pick-a-color-1.2.3.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="filter_functions.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="examples/resources/demo.js"></script>
	<script type="text/javascript" src="media/js/site.js?_=c15b4a384d5ae52f7f3a5cc40ffe0394"></script>
	<script type="text/javascript" src="media/js/dynamic.php?comments-page=examples%2Fplug-ins%2Frange_filtering.html" async=""></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
	
	$insert_css_and_js_into_header
	<link rel="stylesheet" href="$website_root/css/BootSideMenu.css">
	<!-- Custom styles for this template -->
    <link href="$website_root/css/dashboard.css" rel="stylesheet">
    
    <script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$('#example').dataTable( {
		"ajax": "arrays.txt",
		"deferRender": true,
		"order": [[ 0, "desc" ]],
		//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
		"aoColumns": [
			{ "orderSequence": [ "desc", "asc" ] },
            null,
            null,
            null,
            null,
            null,
            null,
			null,
            null,
            null,
            null,
            null,
			null
        ]
	} );
    		
    $('#schools_table').dataTable( {
		"ajax": "arrays_schools.txt",
		"deferRender": true,
		"order": [[ 0, "desc" ]],
		//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
		"aoColumns": [
			{ "orderSequence": [ "desc", "asc" ] },
            null,
            null,
            null,
            null,
            null,
            null,
			null,
            null,
            null,
            null,
            null,
			null
        ]
	} );
    		
    $('[data-toggle="tooltip"]').tooltip();

	var url = window.location;
	// Will only work if string in href matches with location
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
	
	// Will also work for relative and absolute hrefs
	$('ul.nav a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');
    		
	var table = $('#example').DataTable();
	
	$('#showmenu').click(function() {
        $('.menu').slideToggle("fast");
    });


	       //Navigation Menu Slider
	        $('#nav-expander').on('click',function(e){
	      		e.preventDefault();
	      		$('body').toggleClass('nav-expanded');
	      	});
	      	$('#nav-close').on('click',function(e){
	      		e.preventDefault();
	      		$('body').removeClass('nav-expanded');
	      	});

	      	// Initialize navgoco with default options
	        $(".main-menu").navgoco({
	            caret: '<span class="caret"></span>',
	            accordion: false,
	            openClass: 'open',
	            save: true,
	            cookie: {
	                name: 'navgoco',
	                expires: false,
	                path: '/'
	            },
	            slide: {
	                duration: 300,
	                easing: 'swing'
	            }
	        });
} );

// shows the slickbox DIV on clicking the link with an ID of "slick-show"
  $('#slick-show').click(function() {
    $('#slickbox').show('slow');
    return false;
  });
	</script>
EOD;

echo $panel;
?>