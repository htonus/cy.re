<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area.'&action=';

	$headers = array(
		'Preview'	=> null,
		'City'		=> 'city.name',
		'Type'		=> 'realtyType',
		'Price'		=> null,
		'Created'	=> 'created',
		'Published'	=> 'published',
		'Action'	=> null,
	);

	$urlHelper = UrlHelper::create($model);
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<?= $urlHelper->getTableHeader($headers); ?>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
		$featureList = $item->getFeaturesByGroup(FeatureTypeGroup::general());
?>
		<tr>
			<td>
<?php
	if ($preview = $item->getPreview()) {
?>
				<img src="<?= PictureSize::thumbnail()->getUrl($preview)?>" alt="<?= $item->getName()?>"/>
<?php
	} else {
?>
				<img src="<?= PATH_WEB_IMG?>1.gif" alt="<?= $item->getName()?>" style="border: 1px solid red; <?= PictureSize::thumbnail()->getImgStyle()?>" />
<?php
	}
?>
			</td>
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
