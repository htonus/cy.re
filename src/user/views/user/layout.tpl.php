<?php
/*
 * $Id$
 */

	$partViewer->view('_parts/site_title');

?>

<div class="content sub-page">

<?php
	$partViewer->view("$area/$action");
?>

</div>