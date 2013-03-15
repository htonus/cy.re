<?php
/*
 * $Id$
 */

	$url = '/index.php?area=resource&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getType()->getName()?></td>
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
