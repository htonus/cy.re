<?php
/*
 * $Id$
 */
	/*
	$partViewer->view(
		'_parts/admin-bar',
		Model::create()->
			set(
				'adminUrl',
				'?area=custom&action=edit'
				.(
					empty($blockIds[CustomType::CAROUSEL])
						? '&section='.$section->getId().'&type='.CustomType::CAROUSEL
						: '&id='.$blockIds[CustomType::CAROUSEL]
				)
			)
	);
	 */
?>

<div id="myCarousel" class="carousel slide">

<?php
	if (empty($list)) {
?>
	<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/12/blur.jpg" />
<?php
	} else {
?>

	<ol class="carousel-indicators">

<?php
		$i = 0;
		foreach ($list as $item) {
?>
		<li class="<?= $i == 0 ? 'active' : ''?>" data-target="#myCarousel" data-slide-to="<?= $i ++?>"></li>
<?php
		}
?>
	</ol>
	<div class="carousel-inner">
<?php
		$i = 0;
		foreach ($list as $realty) {
?>
		<div class="item <?= $i++ == 0 ? 'active' : ''?>">
			<a href="/<?= $area.'/item/'.$realty->getId() ?>"><img src="<?= PictureSize::carousel()->getUrl($realty->getPreview())?>" alt=""></a>

			<div class="carousel-caption">
				<h4><?= $realty->getName()?></h4>
				<p>
					<?= $realty->getCity() ? $realty->getCity()->getName() : ''?>
					&nbsp; &euro; <?= number_format($realty->getFeatureValue($priceType), 0, '.', "'");?>
				</p>
			</div>
		</div>
<?php
		}
?>
	</div>

	<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>

<script type="text/javascript">
	jq(document).ready(function(){
		jq('#myCarousel').carousel()
	});
</script>
<?php
	}
?>

</div>
