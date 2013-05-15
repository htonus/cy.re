<?php
/*
 * $Id$
 */

	$url = '/index.php?area=featureType';

	if (!empty($group))
		$url .= '&group='.$group->getId();

	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />

				<span class="brand">Choose Group</span>

				<select name="group" onchange="this.form.submit()">
					<option value=""></option>
<?php
	$default = empty($group)
		? null
		: $group->getId();

	foreach ($groupList as $item) {
?>
				<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>

				<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
			</form>
		</div>
	</div>

	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Unit</th>
			<th>Group</th>
			<th>Weight</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getUnit()->getSign()?></td>
			<td><?=$item->getGroup()->getName()?></td>
			<td><?=$item->getWeight()?></td>
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
