<?php
/*
 * $Id$
 */

	if ($action != 'edit')
		$partViewer->view(
			'_parts/site_title',
			Model::create()->
				set('title', 'Realestates stuff')->
				set('hint', 'Be careful with the editing objects in this section. Result could ruin all the website!')
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
	if ($action == 'add' || $action == 'save')
		$action = 'edit';
	
	$partViewer->view("$area/$action")
?>
			</section>
		</div>
	</div>
</div>