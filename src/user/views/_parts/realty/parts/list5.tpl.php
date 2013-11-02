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
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getName();
?>

	<div class="row">
		<div class="span6 hr mt20"></div>
	</div>
	<div class="row">
		<div class="span1">
			<a href="<?= $itemUrl.$id; ?>" title="<?= $title; ?>">
				<img src="<?= PictureSize::list5()->getUrl($item->getPreview())?>">
			</a>
		</div>
		<div class="span4">
				<a href="<?= $itemUrl.$id; ?>"><?= $title?> <b>&euro;</b> <?= $item->getFeatureValue($priceType)?></a>
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
		<div class="span1">
			<a href="<?= $itemUrl.$id; ?>" class="btn btn-small btn-black pull-right">Details</a>
		</div>
	</div>
<?php
	}

	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>


</div>