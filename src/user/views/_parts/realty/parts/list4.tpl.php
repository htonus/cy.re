<?php
/**
 *
 */

	$features2show = array(
		FeatureType::AREA,
		FeatureType::BEDROOMS,
		FeatureType::TOILETS,
	);
?>

<div class="span6 mt20">
	
<?php
	$partViewer->view('_parts/realty/parts/menu');
	$itemUrl = PATH_WEB."$area/item/";
?>

	<div class="row-fluid">

<?php
	$odd = 0;
	
	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getName();

		if ($odd++ % 4 == 0) {
?>
	</div>
	<div class="row-fluid">
<?php
		}
?>
		<div class="span3 list-item">
			<img src="<?= PictureSize::preview()->getUrl($item->getPreview()); ?>">
			<div align="left">
				<a href="<?= $itemUrl.$id; ?>"><b>&euro;</b> <?= $item->getFeatureValue($priceType)?></a>
				<br />
				<small>
<?php
		foreach ($item->getFeaturesByGroup(FeatureTypeGroup::general()) as $typeId => $feature) {
			if (!in_array($typeId, $features2show))
				continue;
			
			echo ucfirst($feature->getType()->getName()).':'.$feature->getValue().' '.$feature->getType()->getSign().' ';
		}
?>
				</small>
			</div>
		</div>
<?php
	}
?>
	</div>
	
<?php
	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>

</div>