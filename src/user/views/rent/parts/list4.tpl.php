<?php
/**
 *
 */
?>

<div class="span6 mt20">
	
<?php
	$partViewer->view("$area/parts/menu");
	$itemUrl = PATH_WEB."$area/item/";
?>

	<div class="row-fluid">

<?php
	$odd = 0;
	
	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getNme();

		if (++$odd % 4 == 0) {
?>
	</div>
	<div class="row">
<?php
		}
?>
		<div class="span3 list-item">
			<img src="<?= PictureSize::preview()->getUrl($item->getPreview()); ?>">
			<h5>
				<a href="<?= $itemUrl.$id; ?>" title="<?= $title; ?>"><?= $title; ?></a>
			</h5>
		</div>
<?php
	}
?>
	</div>
</div>