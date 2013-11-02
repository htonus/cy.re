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
	$partViewer->view("$area/parts/menu");
?>

	<div class="row">
<?php
	$itemUrl = PATH_WEB."$area/item/";

	$odd = false;
	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];
		
		if ($odd % 2) {
?>
	</div>
	<div class="row">
<?php
		}
		
		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getName();
?>
		<div class="span3 list-item">
			<a href="<?= $itemUrl.$item->getId()?>" title="Permalink to Cool Ring">
				<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
			</a>
			<div align="left">
				<a href="<?= $itemUrl.$id; ?>"><?= $title?> for <b>&euro;</b> <?= $item->getFeatureValue($priceType)?></a>
				<br />
				<small>
<?php
		foreach ($item->getFeaturesByGroup(FeatureTypeGroup::general()) as $typeId => $feature) {
			if (!in_array($typeId, $features2show))
				continue;
			
			echo ucfirst($feature->getType()->getName()).': '.$feature->getValue().' '.$feature->getType()->getSign().' ';
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