<?php
/*
 * $Id$
 */

	if ($action != 'edit')
		$partViewer->view(
			'_parts/site_title',
			Model::create()->
				set('title', 'Realty sites')->
				set('hint', 'Does not go to live unless are published by Moderator')
		);
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/realty');

	if ($action == 'index')
		$partViewer->view($area.'/parts/filter');
?>
		</div>

		<div class="span9">
			<section>
<?php
	$partViewer->view("$area/$action")
?>
			</section>
		</div>
	</div>
</div>