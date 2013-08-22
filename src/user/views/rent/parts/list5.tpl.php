<?php
/**
 *
 */
?>

<div class="span6 mt20">

<?php
	$partViewer->view("$area/parts/menu");
	$itemUrl = PATH_WEB."$area/item/";

	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];

		$title = $item->getCity()
			? $item->getRealtyType()->getName().' in '.$item->getCity()->getName()
			: $item->getNme();
?>

	<div class="row">
		<div class="span6 hr mt20"></div>
	</div>
	<div class="row">
		<div class="span1">
			<a href="<?= $itemUrl.$id; ?>" title="<?= $title; ?>">
				<img src="<?= PictureSize::list5()->getUrl($item->getPreview())?>">
			</a>
		</div>
		<div class="span4">
			<h5>
				<a href="<?= $itemUrl.$id; ?>" title="Permalink to Another Work"><?= $title; ?></a>
			</h5>
			Some details
		</div>
		<div class="span1">
			<a href="<?= $itemUrl.$id; ?>" class="btn btn-small btn-black pull-right">Details</a>
		</div>
	</div>
<?php
	}

	if (!empty($pager))
		$partViewer->view('_parts/pager', $pager);
?>

</div>