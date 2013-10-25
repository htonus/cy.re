<?php
/*
 * $Id$
 */

	$baseUrl = $url = '/index.php?area='.$area;
	
	if (!empty($customType))
		$url .= '&type='.$customType->getId();

	if (!empty($section))
		$url .= '&section='.$section->getId();

	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>
	
	<br />
	
	
	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />
				
				<span class="brand">Choose</span>

				<ul class="nav">
					<li><a name="">Type</a></li>
					<li>
						<select name="type" onchange="this.form.submit()" class="span2">
							<option value=""></option>
<?php
	$default = empty($customType)
		? null
		: $customType->getId();

	foreach ($customTypeList as $item) {
?>
							<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
						</select>
					</li>
				
					<li><a name="section">Section</a></li>
					<li>
						<select name="section" onchange="this.form.submit()" class="span2">
							<option value=""></option>
<?php
	$default = empty($section)
		? null
		: $section->getId();

	foreach ($sectionList as $item) {
?>
							<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= i18nHelper::detokenize($item->getName()); ?></option>
<?php
	}
?>
						</select>
					</li>
				</ul>
				
				<a class="btn btn-info" href="<?=$baseUrl?>">Reset</a>
				<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
			</form>
		</div>
	</div>
	
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Type</th>
			<th>Section</th>
			<th>Items</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$itemUrl = '/index.php?area='.$area
			.'&type='.$item->getType()->getId()
			.'&section='.$item->getSection()->getId()
			.'&id='.$item->getId()
			.'&action=';
?>
		<tr>
			<td><?= $item->getType()->getName() ?></td>
			<td><?= i18nHelper::detokenize($item->getSection()->getName()); ?></td>
			<td><?= $item->getItems()->getCount() ?></td>
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
