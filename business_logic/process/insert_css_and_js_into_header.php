<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

$panel = <<<EOD
<link href="$website_root/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="$website_root/css/jqx.base.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="$website_root/css/bootstrap-select.css">
<link href="$website_root/css/styles.css" rel="stylesheet" type="text/css">
<link href="$website_root/css/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="$website_root/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="$website_root/js/ie-emulation-modes-warning.js"></script>
<script src="$website_root/business_logic/process/ajax.js"></script>
<script src="$website_root/js/bootstrap-lightbox.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Custom styles for this template -->
<link href="$website_root/css/carousel.css" rel="stylesheet">
<link href="$website_root/css/bootstrap-lightbox.min.css" rel="stylesheet">
EOD;

echo $panel;
?>