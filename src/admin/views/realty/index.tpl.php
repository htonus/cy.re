<?php
/*
 * $Id$
 */
	
	$url = '/index.php?area='.$area.'&action=';

	$headers = array(
		'Preview'	=> null,
		'City'		=> 'city.i18n.name',
		'Type'		=> 'realtyType.i18n.name',
		'Price'		=> null,
		'Created'	=> 'created',
		'Published'	=> 'published',
		'Action'	=> null,
	);
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>


	<div class="navbar">
		<div class="navbar-inner">
			<form class="navbar-form" action="<?= PATH_WEB_ADMIN?>" method="get">
				<input type="hidden" name="area" value="<?= $area?>" />
				<input type="hidden" name="action" value="edit" />

				<span class="brand">Enter Code</span>
				<input type="text" name="code" class="span1" />
				<button type="submit" class="btn btn-primary">Edit</button>

				<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />
			</form>
		</div>
	</div>
	
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
			<td>
				<b><?= $item->getCode()?></b><br />
				<?= $item->getCity() ? $item->getCity()->getName() : '---'?><br />
<?php
		if ($item->getDistrict())
			echo $item->getDistrict()->getName();
?>
			</td>
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
	
<?php

	$partViewer->view('_parts/pager', $pager->set('url', $urlHelper->getFilterUrl()));
