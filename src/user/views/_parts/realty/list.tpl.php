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
	$partViewer->view('_parts/realty/parts/sidebar-left');
	$partViewer->view('_parts/realty/parts/list'.$listVariant);
	$partViewer->view('_parts/realty/parts/sidebar-right');
?>


			</div>
		</div>

	</section>

