<?php
/*
 * $Id$
 */

	$partViewer->view(
		'_parts/site_title',
		Model::create()->
			set('title', 'District')->
			set('hint', 'First level administrative division of a country')
	);
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/realty');
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