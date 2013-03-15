<?php
/*
 * $Id$
 */

	$partViewer->view(
		'_parts/site_title',
		Model::create()->
			set('title', 'User and Access Management')->
			set('hint', 'Are you sure?')
	);
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/users');
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