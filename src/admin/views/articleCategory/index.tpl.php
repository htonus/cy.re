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
	
	
	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
	
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Articles</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	$default = empty($parent)
		? null
		: $parent->getId();

	$level = 0;
	$parentId = 0;
	foreach ($categoryList as $item) {
		if ($item->getParentId() != $parentId) {
			if ($item->getParentId() < 1)
				$level = 0;
			else
				$level ++;

			$parentId = $item->getParentId();
		}
		$itemUrl = '/index.php?area='.$area
			.'&parent='.($item->getParent() ? $item->getParent()->getId() : null)
			.'&id='.$item->getId()
			.'&action=';
		$artcleUrl = '/index.php?area=article&category='.$item->getId();
?>
		<tr>
			<td width="60%" style="padding-left: <?= $level * 50 ?>px; "><?= $item->getName()?></td>
			<td><a href="<?= $artcleUrl?>"><?= empty($articleCountList[$item->getId()]) ? 0 : $articleCountList[$item->getId()] ?></a></td>
			<td>
				<a href="<?= $artcleUrl?>">articles</a> |
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
