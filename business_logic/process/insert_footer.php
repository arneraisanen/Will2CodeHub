<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];

$panel = <<<EOD
<!-- FOOTER -->
<footer style="margin:60px 30px 10px 30px;">
<p class="pull-right"><a href="#">Back to top</a></p>
<p>&copy; 2016 $website_root &middot; <a href="http://www.arbco.org/business_logic/privacy.php">Privacy</a> &middot; <a href="http://www.arbco.org/business_logic/terms.php">Terms</a> </p>
</footer>
EOD;

echo $panel;
?>