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

	
<?php
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getName();
?>

	<div class="row">
		<div class="span6 list-item">
			<img src="<?= PictureSize::list1()->getUrl($item->getPreview())?>">
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

	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>

</div>