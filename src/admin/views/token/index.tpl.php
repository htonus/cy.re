<?php
/*
 * $Id$
 */

	$url = '/index.php?area=token&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
<?php

	$partViewer->view('_parts/pager', $pager->set('url', $urlHelper->getFilterUrl()));
	
?>
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Token / Text</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td>
				<a href="<?=$url?>edit&id=<?=$item->getId()?>" style="font-family: monospace;"><?= $item->getName(); ?></a>
				<br/>
				<?= StringHelper::me()->cutText($item->getValue(), 100); ?>
			</td>
			<td>
				<a href="<?=$url?>edit&id=<?=$item->getId()?>">edit</a> |
				<a href="<?=$url?>drop&id=<?=$item->getId()?>">drop</a>
			</td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>
	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />

<?php

	$partViewer->view('_parts/pager', $pager->set('url', $urlHelper->getFilterUrl()));
	
