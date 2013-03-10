<?php
/*
 * $Id$
 */

	$url = '/index.php?area=language&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Native</th>
			<th>Code</th>
			<th>Is active</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getNative()?></td>
			<td><?=$item->getCode()?></td>
			<td><a href="/index.php?area=language&action=toggle&id=<?=$item->getId()?>" class="badge badge-<?=$item->isActive() ? 'success' : 'important'?>">&nbsp;</a></td>
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
