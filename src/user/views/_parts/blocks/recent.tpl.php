<?php
/**
 *
 */

	if (empty($title))
		$title = '___TTL-RECENT___';

	$features2show = array(
		FeatureType::BEDROOMS		=> 'ico-bed',
		FeatureType::TOILETS		=> 'ico-bath',
		FeatureType::PARKING_LOTS	=> 'ico-car',
		FeatureType::AREA			=> 'ico-area',
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
			? ucfirst($item->getRealtyType()->getName()).'<span class="visible-desktop">, '.$item->getCity()->getName().'</span>'
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
						<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>" width='100%'>
					</a>
					<div class="list3">
						<a href="<?= $url ?>"><?= $title?> <b class="pull-right">&euro; <?= number_format($item->getFeatureValue($priceType), 0, '', "'") ?></b></a>
						<br />
						<small>
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
						</small>
					</div>
				</div>
<?php
	}
?>
			</div>
		</div>
