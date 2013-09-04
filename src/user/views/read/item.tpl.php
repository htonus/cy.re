<?php
/*
 * $Id$
 *
 * expect:
 *	- $name
 */


	$gradusnik = array();

	if ($category) {
		$item = $category;
		while($item = $item->getParent()) {
			$gradusnik[$item->getWebSlug()] = $item->getName();
		}
	}

	$prefix = PATH_WEB.Section::read()->getSlug().'/';
	$model->set('prefix', $prefix);
?>
	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3>
<?php
	if ($category) {
?>
						<?= $category->getName()?> <strong>:</strong> <?= $article->getName()?>
<?php
	} else {
?>
						Legal Information, Guides and other Articles
<?php
	}
?>
					</h3>

<?php
	if ($category) {
?>
					<div class="gradus">
						<a class="subpage_block" href="<?= $prefix?>">Home</a> /
<?php
	if (!empty($gradusnik)) {

		foreach ($gradusnik as $slug => $name) {
?>
			<a class="subpage_block" href="<?= $prefix.$slug?>"><?= $name?></a> /
<?php
		}
	}
?>
						<span><?= $category->getName()?></span>
					</div>
<?php
	}
?>
				</div>
			</div>
		</div>
	</div>

	<div class="section">

		<div class="container">
			<div class="row">

				<div class="span6 mt20">

					<div class="well well-small">

						<b><?= $article->getBrief()?></b>

					</div>

					<?= $article->getText()?>

					<div class="clearfix"></div>
					<div class="pull-right green mt20"><?= $article->getPublished()->toDate()?></div>

				</div>

				<div class="span6 mt20">
<?php

	$partViewer->view(
		'_parts/widget/gallery',
		Model::create()->set('list', $article->getPictures()->getList())
	);

?>

				</div>

			</div>
		</div>

	</div>
