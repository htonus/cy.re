<?php
/*
 * $Id$
 */
?>

<?php
	$partViewer->view('_parts/site_title');
?>
<div class="container">
	<div class="row">
		<div class="span3">
<?php
	$partViewer->view('_parts/menu/dictionaries');
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