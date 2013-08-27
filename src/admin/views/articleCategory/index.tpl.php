<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area;
	
	if (!empty($parent))
		$url .= '&parent='.$parent->getId();
	
	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>
	
	<br />
	
	
	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />
				
				<span class="brand">Choose Category</span>

				<select name="parent" onchange="this.form.submit()">
					<option value=""></option>
<?php
	$default = empty($parent)
		? null
		: $parent->getId();
	
	$level = 0;
	$parentId = 0;
	foreach ($topList as $item) {
		if ($item->getParentId() != $parentId) {
			if ($item->getParentId() < 1)
				$level = 0;
			else
				$level ++;
			
			$parentId = $item->getParentId();
		}
?>
					<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>>
						<?= str_repeat(' &nbsp; &nbsp;  ', $level) ?> 
						<?= $item->getName()?>
					</option>
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
			<th>Parent</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$itemUrl = '/index.php?area='.$area
			.'&parent='.($item->getParent() ? $item->getParent()->getId() : null)
			.'&id='.$item->getId()
			.'&action=';
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getParent() ? $item->getParent()->getName() : '---' ?></td>
			<td>
				<a href="<?= $itemUrl?>edit">edit</a> |
				<a href="<?= $itemUrl?>drop">drop</a>
			</td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>
<!--	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />-->
