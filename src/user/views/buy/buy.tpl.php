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
	$partViewer->view('list/parts/sidebar-left');
	$partViewer->view('list/parts/list2');
	$partViewer->view('list/parts/sidebar-right');
?>


			</div>
		</div>

	</section>

