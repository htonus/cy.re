<?php
/**
 *
 */

	if (empty($title))
		$title = '___TTL-RECENT___';

	$features2show = array(
		FeatureType::AREA,
		FeatureType::BEDROOMS,
		FeatureType::TOILETS,
	);
?>
		<div class="container offers">

			<h3><?= $title ?></h3>

<?php
	$partViewer->view(
		'_parts/admin-bar',
		$model->
			set(
				'adminUrl',
				'?area=custom&action=edit'
				.(
					empty($blockIds[CustomType::RECENT])
						? '&section='.$section->getId().'&type='.CustomType::RECENT
						: '&id='.$blockIds[CustomType::RECENT]
				)
			)
	);
?>
			
			<div class="row">
<?php
	foreach ($blocks[CustomType::RECENT] as $item) {
		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in  '.$item->getCity()->getName()
			: $item->getName();
		
		$url = PATH_WEB.$area.'/item/'.$item->getId();
?>
				<div class="span3 list-item">
<?php
	$partViewer->view(
		'_parts/admin-bar',
		$model->set(
			'adminUrl',
			'?area=realty&action=edit&id='.$item->getId()
		)
	);
?>
					<a href="<?= $url ?>" title="Permalink to Another Work">
						<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
					</a>
					<div align="left">
						<a href=""><?= $title?> for <b>&euro;</b> <?= $item->getFeatureValue($priceType)?></a>
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
		</div>
