<?php
/*
 * $Id$
 */
?>

<?php
	$partViewer->view('_parts/site_title');
?>

<div class="row">
	<div class="span3">
<?php
	$partViewer->view('_parts/menu/dictionaries');
?>
	</div>
	
	<div class="span9">
<?php
	$partViewer->view('$area/$action')
?>
	</div>
</div>