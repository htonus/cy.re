<?php
/*
 * $Id$
 */
?>

<div class="content">

<?php
	$partViewer->view('_parts/site_title');
	
	$partViewer->view("$area/$action");

	$partViewer->view('_parts/site_footer');
?>

</div>