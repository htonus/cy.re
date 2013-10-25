<?php
/*
 * $Id$
 */

	$baseUrl = $url = '/index.php?area='.$area;

	if (!empty($type))
		$url .= '&type='.$type->getId();

	if (!empty($section))
		$url .= '&section='.$section->getId();

	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

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
	$default = empty($type)
		? null
		: $type->getId();

	foreach ($staticTypeList as $item) {
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
			<th>Name</th>
			<th>Section</th>
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
			<td><?=$item->getSection() ? i18nHelper::detokenize($item->getSection()->getName()) : 'all sections'?></td>
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
