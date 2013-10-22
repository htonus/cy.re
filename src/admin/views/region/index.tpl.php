<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area;
	
	if (!empty($country))
		$url .= '&country='.$country->getId();
	
	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>
	
	<br />
	
	
	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />
				
				<span class="brand">Choose Country</span>

				<select name="country" onchange="this.form.submit()">
					<option value=""></option>
<?php
	$default = empty($country)
		? null
		: $country->getId();
	
	foreach ($countryList as $item) {
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
			<th>Country</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$itemUrl = '/index.php?area='.$area
			.'&country='.$item->getCountry()->getId()
			.'&id='.$item->getId()
			.'&action=';
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getCountry()->getName()?></td>
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
