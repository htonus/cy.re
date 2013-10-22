<?php
/*
 * $Id$
 */

	$baseUrl = $url = '/index.php?area='.$area;
	
	if (!empty($section))
		$url .= '&section='.$section->getId();

	$url .= '&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>
	
	<br />
	
	
	<div class="navbar">
		<div class="navbar-inner">
			<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
		</div>
	</div>
	
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>ISO Code</th>
			<th>Phone code</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$itemUrl = '/index.php?area='.$area
			.'&id='.$item->getId()
			.'&action=';
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getCountryCode()?></td>
			<td><?=$item->getPhoneCode()?></td>
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
