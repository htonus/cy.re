<?php
/*
 * $Id$
 */
?>

	<section>

		<div class="container main">
			<div class="row">

				<div class="span4">
<?php
	$partViewer->view('_parts/form/login');
?>

					<!--p class="intro">Simple and flexible HTML, CSS, and Javascript for popular user interface components and interactions.</p -->
					<br />

					<form action="/<?= $area?>/list" method="get">
<?php
	$partViewer->view('_parts/form/filter');
?>
					</form>

				</div>

				<div class="span8">
<?php
	$partViewer->view(
		'_parts/js', Model::create()->set('name', 'bootstrap-carousel')
	);

	$partViewer->view(
		'_parts/blocks/carousel',
		Model::create()->
			set('list', $blocks[CustomType::CAROUSEL])->
			set('area', $area)
	);
?>
				</div>

			</div>
		</div>


<?php

	$partViewer->view(
		'_parts/blocks/latest',
		Model::create()->
			set('list', empty($latestList) ? array() : $latestList)
	);

	$partViewer->view(
		'_parts/blocks/recent',
		Model::create()->
			set('area', $area)->
			set('list', $blocks[CustomType::RECENT])
	);

	$partViewer->view(
		'_parts/blocks/promote',
		Model::create()->
			set('area', $area)->
			set('article', $promote)
	);
?>
	</section>