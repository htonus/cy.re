<?php
/*
 * $Id$
 *
 * expect:
 *	- $name
 */


	$gradusnik = array();

	$prefix = PATH_WEB.Section::project()->getSlug().'/';
?>
	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3>
						Project <strong>:</strong> <?= $article->getName()?>
					</h3>
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
		Model::create()->set('subject', $article)
	);

?>

				</div>

			</div>
		</div>

	</div>

<?php

	if ($list = $article->getSites()->getList()) {
		$partViewer->view(
			'_parts/blocks/recent',
			Model::create()->
				set('title', '___Nearest properties sites___')->
				set('list', $list)
		);
	}

?>
