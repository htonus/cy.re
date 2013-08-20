<?php
/*
 * $Id$
 */
	
?>
	<b><?= $article->getBrief()?></b>
	<br />
	<br />
	
	<?= $article->getText(); ?>
	
	<b class="pull-right">Published: <?= $article->getCreated()->toString()?></b>
	<div class="clearfix"></div>
