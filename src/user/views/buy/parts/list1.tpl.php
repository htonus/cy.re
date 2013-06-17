<?php
/**
 *
 */
?>

<div class="span6 mt20">

<?php
	$partViewer->view("$area/parts/menu");
?>

	
<?php
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? ucfirst($item->getRealtyType()->getName()).' in '.$item->getCity()->getName()
			: $item->getNme();
?>

	<div class="row">
		<div class="span6 list-item">
			<img src="<?= PictureSize::list1()->getUrl($item->getPreview())?>">
			<h5>
				<a href="<?= $itemUrl.$id?>" title="Permalink to Another Work"><?= $title; ?></a>
			</h5>
			Some details
		</div>
	</div>

<?php
	}
?>

</div>