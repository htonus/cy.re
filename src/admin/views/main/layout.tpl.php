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
		<div class="span3">
<?php
	if (empty($user)) {
?>
		<div class="span12">
			<section>
<?php
	$partViewer->view("$area/$action");
?>
			</section>
		</div>

<?php
	} else {
?>
		<div class="span12">
			<section>
<?php
		$partViewer->view('_parts/menu/main');
?>
		</div>

		<div class="span9">
			<section>
<?php
		$partViewer->view("$area/$action");
	}
?>
			</section>
		</div>
	</div>
</div>