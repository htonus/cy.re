<?php
/**
 *
 */
	$features2show = array(
		FeatureType::BEDROOMS		=> 'ico-bed',
		FeatureType::TOILETS		=> 'ico-bath',
		FeatureType::PARKING_LOTS	=> 'ico-car',
		FeatureType::AREA			=> 'ico-area',
	);
?>

<div class="span6 mt20">

<?php
	$partViewer->view('_parts/realty/parts/menu');
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
			? ucfirst($item->getRealtyType()->getName()).', '.$item->getCity()->getName()
			: $item->getName();
?>
		<div class="span3 list-item">
			<a href="<?= $itemUrl.$item->getId()?>" title="Permalink to Cool Ring">
				<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
			</a>
			<div class="list2">
				<a href="<?= $itemUrl.$id; ?>"><?= $title?> <b>&euro; <?= number_format($item->getFeatureValue($priceType), 0, '' , "'") ?></b></a>
				<br />
<?php
		$features = $item->getFeaturesByGroup(FeatureTypeGroup::general());

		foreach ($features2show as $typeId => $icon) {
			if (!isset($features[$typeId]))
				continue;
?>
					<div class="feature-icon">
						<div class="<?= $icon ?>" title="<?= ucfirst($features[$typeId]->getType()->getName()) ?>"></div>
						<span class="value"><?= $features[$typeId]->getValue() ?></span>
					</div>
					&nbsp;
<?php
		}
?>
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