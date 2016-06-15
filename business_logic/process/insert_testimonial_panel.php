<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$website_root = 'http://'. $_SERVER['SERVER_NAME'];
require_once $doc_root.'/business_logic/admin/db/db_manager.php';

try
{
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$STH = $DBH->prepare("SELECT id, name, image, text FROM testimonials ORDER BY id ASC");
	$STH->execute();

	$STH->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "I'm sorry, an error occurred.  Please see PDOErrors.txt for details.";

	file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	exit;
}

$indicators = "";
$row_count = $STH->rowCount();
for ($i=0; $i<$row_count; $i++)
{
	if ($i == 0)
	{
		$indicators .= '
			<li data-target="#carousel-example-generic" data-slide-to="' . $i . '" class="active"></li>';
	}
	else 
	{
		$indicators .= '
			<li data-target="#carousel-example-generic" data-slide-to="' . $i . '"></li>';
	}

}


$testimonials_text = '';
$count = 1;
while($row = $STH->fetch())
{
	if ($count == 1)
	{
		$testimonials_text .= '
		<div class="item active">
			<div class="carousel-caption">
				<div class="testimoni-icon">
					<img src="images/icon-testimonial.png" alt="...">
				</div>
				<div class="testimonial-test">
					<p>
						' . $row["text"] . '
					</p>
					<h5>- ' . $row["name"] . '</h5>
				</div>
			</div>
		</div>';
	}
	else 
	{
		$testimonials_text .= '
		<div class="item">
			<div class="carousel-caption">
				<div class="testimoni-icon">
					<img src="images/icon-testimonial.png" alt="...">
				</div>
				<div class="testimonial-test">
					<p>
						' . $row["text"] . '
					</p>
					<h5>- ' . $row["name"] . '</h5>
				</div>
			</div>
		</div>';
	}
	$count++;
}

$panel = <<<EOD
						<div class="testimonials-main">
							<div class="container">
								<div class="testimonials">
									<h1>Testimonials</h1>
								</div>
								<div class="testimonials-slider">
									<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										<ol class="carousel-indicators">
											$indicators
										</ol>
	
										<!-- Wrapper for slides -->
										<div class="carousel-inner" role="listbox">
											$testimonials_text
										</div>
	
										<!-- Controls -->
										<a class="left carousel-control cc" href="#carousel-example-generic" role="button" data-slide="prev">
											<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="right carousel-control cc" href="#carousel-example-generic" role="button" data-slide="next">
											<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span>
										</a>
									</div>
								</div>
							</div>
						</div>
EOD;

echo $panel;
?>