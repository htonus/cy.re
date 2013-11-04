<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area
		.'&category='.(empty($category) ? null : $category->getId())
		.'&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>


	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />

				<span class="brand">Choose Category</span>

				<select name="category" onchange="this.form.submit()">
					<option value=""></option>
<?php
	$default = empty($category)
		? null
		: $category->getId();

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
			<th>ID</th>
			<th>Name</th>
			<th>Category</th>
			<th>Created</th>
			<th>Published</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?= $item->getId()?></td>
			<td><?=$item->getName()?></td>
			<td><?=$item->getCategory() ? $item->getCategory()->getName() : '---'?></td>
			<td><?=$item->getCreated()->toString()?></td>
			<td><?=$item->getPublished() ? $item->getPublished()->toString() : '---'?></td>
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

<?php
	$partViewer->view('_parts/pager', $pager->set('url', $urlHelper->getFilterUrl()));
	