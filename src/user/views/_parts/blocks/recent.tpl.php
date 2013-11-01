<?php
/**
 *
 */

	if (!empty($list)) {

		if (empty($title))
			$title = '___TTL-RECENT___';
?>
		<div class="container offers">

			<h3><?= $title ?></h3>

			<div class="row">
<?php
	foreach ($list as $item) {
		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in  '.$item->getCity()->getName()
			: $item->getName();
		
		$url = PATH_WEB.$area.'/item/'.$item->getId();
?>
				<div class="span3 list-item">
					<a href="<?= $url ?>" title="Permalink to Another Work">
						<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
					</a>
					<h5>
						<a href="<?= $url ?>" title="Permalink to Another Work"><?= $title?></a>
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
