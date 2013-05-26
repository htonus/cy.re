<?php
/**
 *
 */
?>

<div class="span6 mt20">

	<div class="row">
		<div class="span6">
			<a href="#" class="btn btn-small btn-black active">List</a>
			<a href="#" class="btn btn-small btn-black">2-column</a>
			<a href="#" class="btn btn-small btn-black">4-column</a>
		</div>
	</div>

	<br/>
	
	<div class="row">
<?php
	$itemUrl = PATH_WEB."$area/item/";
	
	$odd = false;
	foreach ($realtyList as $item) {
		
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

</div>