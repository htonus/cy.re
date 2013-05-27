<?php
/*
 * $Id$
 */

	if ($action != 'edit')
		$partViewer->view(
			'_parts/site_title',
			Model::create()->
				set('title', 'Static pages')->
				set('hint', 'Static Texts for header / footer')
		);
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/content');
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