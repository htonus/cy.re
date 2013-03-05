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

<div class="row">
	<div class="span3">
		&nbsp;
	</div>
	
	<div class="span9">
<?php
	echo '&nbsp;';
?>
	</div>
</div>