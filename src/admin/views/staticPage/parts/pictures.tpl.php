<?php
/**
 * $Id$
 */

	if ($form->getValue('id')) {
		$partViewer->view('_parts/form/file_upload');
	} else {
?>
	<div class="alert alert-info">You need to save new Article first. Then you could manage the pictures.</div>
<?php
	}

