<?php
/**
 *
 */

	$features2show = array(
		FeatureType::BEDROOMS		=> 'ico-bed',
		FeatureType::TOILETS		=> 'ico-bath',
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
			? ucfirst($item->getRealtyType()->getName())
			: $item->getName();

		if ($odd++ % 4 == 0) {
?>
	</div>
	<div class="row-fluid">
<?php
		}
?>
		<div class="span3 list-item">
			<img src="<?= PictureSize::preview()->getUrl($item->getPreview()); ?>" title="<?= $item->getCity()->getName() ?>">
			<div class="list3">
				<a href="<?= $itemUrl.$id; ?>">
					<b>&euro; <?= number_format($item->getFeatureValue($priceType), 0, '', "'"); ?></b>
					<br />
					<?= $title?>
					<br />
				</a>
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
<?php
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