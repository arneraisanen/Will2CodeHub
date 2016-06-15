<?php
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-blog-header.php');

echo '<hr class="featurette-divider" style="margin: 10px 0 0px 0;">';

echo '		<div class="row featurette">';
echo '        <div class="col-md-12">';

        		$posts = get_pages('number=1&include='.$id);

        		foreach ($posts as $post) : start_wp();
				the_title('<h2 class="featurette-heading">', '</h3>');
echo '          	<p></p><br />';
echo '          	<div class="table-responsive">';
				the_content();
echo '			</div>';
				endforeach;
			
echo '        </div>';
echo '      </div>';

echo '      <hr class="featurette-divider">';
?>