<?php
/*
 * $Id$
 */
	$partViewer->view(
		'_parts/site_title',
		Model::create()->
			set('title', 'Welcome')->
			set('hint', 'Cyprus-Realty.com back-office!')
	);
?>

<div class="container">
	<div class="row">
		<div class="span12">
<?php
	$partViewer->view("$area/$action");
?>
		</div>
	</div>
</div>