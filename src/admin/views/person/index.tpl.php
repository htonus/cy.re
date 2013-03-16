<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area.'&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Groups</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$groups = '';
		foreach ($item->getGroups()->getList() as $group)
			$groups .= '<a href="index.php?area=group&action=edit&id='.$group->getId().'">'.$group->getName().'</a> ';
		
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getStatus() ? $item->getStatus()->getName() : null?></td>
			<td><?=$groups?></td>
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
