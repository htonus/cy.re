<?php
/**
 *
 */
?>

<div class="span3 mt20">
	
	<h4>_S__HISTORY___</h4>

<?php
//	$partViewer->view('_parts/attention');
//	$partViewer->view('_parts/side-news');
	
	if (!empty($history)) {
		$pictureSize = PictureSize::list2();
		
		foreach ($history as $id => $item) {
?>
	<div id="history_<?= $id ?>" class="mb20">
		<a href="<?= PATH_WEB_USER ?><?= $section->getSlug() ?>/item/<?= $id ?>">
			<image src="<?= $pictureSize->getUrl($item->getPreview()) ?>" width="<?= $pictureSize->getWidth() ?>" height="<?= $pictureSize->getHeight() ?>" />
			<p>
				<?= $item->getCity()->getName() ?>, <?= $item->getRealtyType()->getName() ?>
				<span class="pull-right">&euro;&nbsp;<?= $item->getFeatureValue($priceType) ?></span>
			</p>
		</a>
	</div>
	
<?
		}
	}
?>

</div>