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

	
<?php
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).', '.$item->getCity()->getName()
			: $item->getName();
?>

	<div class="row mb20">
		<div class="span6 list-item list1">
			<img src="<?= PictureSize::list1()->getUrl($item->getPreview())?>">
			<div class="specs">
				<span class="pull-right mt10">
<?php
		$features = $item->getFeaturesByGroup(FeatureTypeGroup::general());

		foreach ($features2show as $typeId => $icon) {
			if (!isset($features[$typeId]))
				continue;

?>
							<span class="feature-icon">
								<div class="<?= $icon ?>" title="<?= ucfirst($features[$typeId]->getType()->getName()) ?>"></div>
								<div class="value"><?= $features[$typeId]->getValue() ?></div>
							</span>
							&nbsp;
<?php
		}
?>
				</span>
				<a href="<?= $itemUrl.$id; ?>">
					<b><?= $title?></b><br/>
					<b class="big">&euro; <?= number_format($item->getFeatureValue($priceType), 0, '', "'") ?></b>
				</a>
			</div>
		</div>
	</div>

<?php
	}

	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>

</div>