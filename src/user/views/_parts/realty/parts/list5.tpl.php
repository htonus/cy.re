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
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).', '.$item->getCity()->getName()
			: $item->getName();
?>

	<div class="row">
		<div class="span6 hr mt20"></div>
	</div>
	<div class="row">
		<div class="list-item">
		<div class="span1">
			<a href="<?= $itemUrl.$id; ?>" title="<?= $title; ?>">
				<img src="<?= PictureSize::list5()->getUrl($item->getPreview())?>">
			</a>
		</div>
		<div class="span4">
			<div class="list2">
				<a href="<?= $itemUrl.$id; ?>">
					<b>&euro; <?= number_format($item->getFeatureValue($priceType), 0, '', "'"); ?></b>
					<?= $title?>
				</a>
				<br />
				<small>
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
				</small>
			</div>
		</div>
		<div class="span1">
			<button onclick="document.location.href='<?= $itemUrl.$id; ?>';" class="btn btn-small btn-black pull-right">Details</button>
		</div>
	</div>
	</div>
<?php
	}

	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>


</div>