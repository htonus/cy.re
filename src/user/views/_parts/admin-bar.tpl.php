<?php
/**
 *
 */

	if (!$user->isAdmin())
		return;
?>
	<div class="row-fluid admin">
		<div class="span12 input-block-level alert alert-info">
			<a href="<?= PATH_WEB_ADMIN.$adminUrl ?>" class="pull-left badge badge-inactive" target="_blank">edit</a>
		</div>
	</div>
