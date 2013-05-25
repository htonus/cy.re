<?php
/*
 * $Id$
 */

	$partViewer->view('_parts/page_title');

?>

	<section>

		<div class="container">
			<div class="row">

<?php
	$partViewer->view($area.'/parts/sidebar-left');
	$partViewer->view($area.'/parts/list2');
	$partViewer->view($area.'/parts/sidebar-right');
?>


			</div>
		</div>

	</section>

