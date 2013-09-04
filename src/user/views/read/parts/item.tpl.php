<?php
/*
 * $Id$
 */
	
?>
	<b><?= $article->getBrief()?></b>
	<br />
	<br />
	
	<?= $article->getText(); ?>
	
	<b class="pull-right">Published: <?= $article->getCreated()->toDate()?></b>
	<div class="clearfix"></div>
