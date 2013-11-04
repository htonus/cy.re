<?php
/*
 * $Id$
 */

	if ($action != 'edit')
		$partViewer->view(
			'_parts/site_title',
			Model::create()->
				set('title', 'Articles : '.ucfirst($area))->
				set('hint', 'Does not go to live unless are published by Moderator')
		);
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/article');
?>
		</div>

		<div class="span9">
			<section>
<?php
	$partViewer->view('_parts/article/'.$action);
?>
			</section>
		</div>
	</div>
</div>