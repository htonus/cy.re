<?php

?>

	<div class="row">
		<div class="span6">
<?php
	foreach ($listVariantList as $id => $limit) {
?>
			<a href="<?= $pager->get('url').'&list='.$id; ?>" class="btn btn-small btn-black <?= $id == $listVariant ? 'active' : null; ?>">___LIST_TYPE_<?= $id?>___</a>
<?php
	}
?>
		</div>
	</div>

	<br/>
