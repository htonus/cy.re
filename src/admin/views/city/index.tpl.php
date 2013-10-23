<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area;
	
	if (!empty($country))
		$url .= '&country='.$country->getId();
	
	if (!empty($region))
		$url .= '&region='.$region->getId();
	
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
					<li><a name="">Country</a></li>
					<li>
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
					</li>
				</ul>

				<ul class="nav">
					<li><a name="">District</a></li>
					<li>
						<select name="region" onchange="this.form.submit()">
							<option value=""></option>
<?php
	$default = empty($region)
		? null
		: $region->getId();

	foreach ($regionList as $item) {
?>
							<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
						</select>
					</li>
				</ul>

				<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
			</form>
		</div>
	</div>
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Country</th>
			<th>District</th>
			<th>Longitude</th>
			<th>Latitude</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?= $item->getName()?></td>
			<td><?= $item->getCountry()->getName() ?></td>
			<td><?= $item->getRegion() ? $item->getRegion()->getName() : null?></td>
			<td><?= $item->getLatitude() ?></td>
			<td><?= $item->getLongitude() ?></td>
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
