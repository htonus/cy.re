<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area.'&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>City</th>
			<th>Type</th>
			<th>Price</th>
			<th>Created</th>
			<th>Published</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$featureList = $item->getFeaturesByGroup(FeatureTypeGroup::general());
?>
		<tr>
			<td><?=$item->getName()?></td>
			<td><?=$item->getCity()->getName()?></td>
			<td><?=$item->getRealtyType()->getName()?></td>
			<td><?=empty($featureList[FeatureType::PRICE]) ? '---' : number_format($featureList[FeatureType::PRICE]->getValue()) ?></td>
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
	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
