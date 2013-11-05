<?php
/**
 *
 */

	if (!$user->isAdmin())
		return;
?>
	<div class="input-block-level alert alert-success">
		<a href="<?= $adminUrl ?>" target="_blank">edit</a>
	</div>
