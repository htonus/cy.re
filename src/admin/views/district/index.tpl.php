<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area;
	
	if (!empty($city))
		$url .= '&city='.$city->getId();
	
	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>
	
	<br />
	
	
	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="<?= $action?>" />
				
				<span class="brand">Choose City</span>

				<select name="city" onchange="this.form.submit()">
					<option value=""></option>
<?php
	$default = empty($city)
		? null
		: $city->getId();
	
	foreach ($cityList as $city) {
?>
				<option value="<?= $city->getId()?>"<?= $city->getId() == $default ? ' selected="selected"' : null?>><?= $city->getName()?></option>
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
			<th>City</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getCity()->getName()?></td>
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
<!--	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />-->
