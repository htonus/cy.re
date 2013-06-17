<?php
/*
 * $Id$
 */

	if ($pages < 2)
		return;
	
	$url .= '&page=';
?>
<div class="pagination wysiwyg-text-align-center">
	<ul>
		<li class="<?= $page == 1 ? 'disabled' : null; ?>"><a href="<?= $url.($page - 1); ?>">&laquo;</a></li>
<?php
	for ($i = 1; $i <= $pages; $i ++) {
?>
		<li class="<?= $page == $i ? 'active' : null; ?>"><a href="<?= $url.$i; ?>"><?= $i; ?></a></li>
<?php
	}
?>
		<li class="<?= $page == $pages ? 'disabled' : null; ?>"><a href="<?= $url.($page + 1); ?>">&raquo;</a></li>
	</ul>
</div>
