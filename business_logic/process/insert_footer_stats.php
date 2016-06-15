<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

$panel = <<<EOD
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="$website_root/js/bootstrap.min.js"></script>
	<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="$website_root/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="$website_root/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="$website_root/js/register_teacher.js"></script>

    <script type="text/javascript" src="$website_root/js/jqxcore.js"></script>
	<script type="text/javascript" src="$website_root/js/jqxdatetimeinput.js"></script>
	<script type="text/javascript" src="$website_root/js/jqxcalendar.js"></script>
	<script type="text/javascript" src="$website_root/js/globalize.js"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-77171224-1', 'auto');
	  ga('send', 'pageview');
	</script>
EOD;

echo $panel;
?>