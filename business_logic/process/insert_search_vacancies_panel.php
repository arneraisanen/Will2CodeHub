<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

ob_start();
include($doc_root."/business_logic/user_admin/get_states.php");
$states= ob_get_contents();
ob_end_clean();

ob_start();
include($doc_root."/business_logic/user_admin/get_subjects.php");
$subjects= ob_get_contents();
ob_end_clean();

$logo = 'http://'. $_SERVER['SERVER_NAME'].'/images/logo.png';
$website_root = 'http://'. $_SERVER['SERVER_NAME'];

$panel = <<<EOD
<div class="container">
	<form id="" action="$website_root/business_logic/find_a_vacancy.php" method="post" enctype="multipart/form-data">
		<div class="find-teacher">
			<div class="banner">
				<h2>Search for open vacancies</h2>
				<div class="become-teacher">
					<div class="row">
						<div class="col-sm-5">
							<label>Location</label>
								<div class="form-group select-op">
									<select name="preferredLocation" id="districts" class="form-control" title="District">									
											$states
									</select>
								</div>
						</div>
						<div class="col-sm-5">
							<label>Subject</label>
								<div class="form-group select-op">
									<select name="subject" id="subject" class="form-control" title="Subject">			
											$subjects
									</select>
								</div>
						</div>
						<div class="col-sm-2">
							<a id="seachTeachers" href="" class="search-btn"><i
								class="fa fa-search"></i></a>
						</div>
					</div>
			
				</div>
				<div class="becoming-teacher">
					<img
						src="$website_root/images/becoming-teacher.png" />
				</div>
			</div>
		</div>
	</form>
</div>
EOD;

echo $panel;
?>