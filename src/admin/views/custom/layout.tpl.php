<?php
/*
 * $Id$
 */

	$partViewer->view(
		'_parts/site_title',
		Model::create()->
			set('title', 'Contet management')->
			set('hint', 'Main blocks and static pages')
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