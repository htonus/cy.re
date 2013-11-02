<?php
/*
 * $Id$
 */

	$partViewer->view('_parts/site_title');

?>

<div class="content sub-page">

<?php
	$partViewer->view("_parts/realty/$action");

	$partViewer->view('_parts/site_footer');
?>

</div>