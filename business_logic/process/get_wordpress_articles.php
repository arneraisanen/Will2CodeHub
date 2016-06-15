<?php
/*
$doc_root = $_SERVER['DOCUMENT_ROOT'];
require_once $doc_root.'/business_logic/admin/db/db_manager_wordpress.php';

$id = $_GET["id"];

try
{
	$DBH2 = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH2 = $DBH2->prepare("SELECT post_title, post_content FROM wp_posts WHERE ID='$id'");
	$STH2->execute();

	$STH2->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";
	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}


while($row = $STH2->fetch())
{
	$post_title = $row["post_title"];
	$post_content = $row["post_content"];
}

$text_panel = <<<EOD
	<div class="row featurette">
        <div class="col-md-12">
        	<h2 class="featurette-heading">$post_title<span class="text-muted"></span></h2>
          	<p class="lead"></p>
          	<p></p><br />
          	<h2 class="sub-header"></h2>
          	<div class="table-responsive">
            	$post_content
          	</div>
        </div>
    </div>
EOD;

echo $text_panel;
*/
echo 'Title:' . $post_title;
?>