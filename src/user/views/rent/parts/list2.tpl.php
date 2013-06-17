<?php
/**
 *
 */
?>

<div class="span6 mt20">

<?php
	$partViewer->view("$area/parts/menu");
?>

	<div class="row">
<?php
	$itemUrl = PATH_WEB."$area/item/";

	$odd = false;
	foreach ($list as $id => $relevance) {
		$item = $objectList[$id];
		
		if ($odd % 2) {
?>
	</div>
	<div class="row">
<?php
		}
		
		$title = $item->getCity()
			? $item->getRealtyType()->getName().' in '.$item->getCity()->getName()
			: $item->getNme();
?>
		<div class="span3 list-item">
			<a href="<?= $itemUrl.$item->getId()?>" title="Permalink to Cool Ring">
				<img src="<?= PictureSize::list2()->getUrl($item->getPreview())?>">
			</a>
			<h5>
				<a href="<?= $itemUrl.$item->getId()?>" title="<?= $title?>">
				<?= $title?>
			</a>
			</h5>
			Some details
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