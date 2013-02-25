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
				<h1>Items of type: <?=ucfirst($area)?></h1>
<?php
	$partViewer->view("$area/$action")
?>
			</section>
		</div>
	</div>
</div>