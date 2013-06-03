<?php
/**
 *
 */

	if (!empty($list)) {
?>
		<div class="container offers">

			<h3>Recent offers</h3>

			<div class="row">
<?php
	foreach ($list as $item) {
		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in  '.$item->getCity()->getName()
			: $item->getName();
?>
				<div class="span3 list-item">
					<a href="<?= PATH_WEB.$area.'/item/'.$item->getId()?>" title="Permalink to Another Work">
						<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
					</a>
					<h5>
						<a href="<?= PATH_WEB.$area.'/item/'.$item->getId()?>" title="Permalink to Another Work"><?= $title?></a>
					</h5>
					Price: <b>&euro;</b> <?= $item->getFeatureValue(FeatureType::PRICE)?>
				</div>
<?php
	}
?>
			</div>
		</div>
<?php
	}