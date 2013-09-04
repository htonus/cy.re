<?php
/*
 * $Id$
 *
 * expect:
 *	- $name
 */


	$partViewer->view(
		'_parts/page_title',
		Model::create()->
			set('title', ucfirst($subject->getRealtyType()->getName()).' in '.$subject->getCity()->getName())->
			set('subtitle', null)
	);

	$pictureList = $subject->getPictures()->getList();
?>

	<div class="section">

		<div class="container">
			<div class="row">

				<div class="span8 mt20">
<?php

	$partViewer->view(
		'_parts/widget/gallery',
		Model::create()->
			set('list', $subject->getPictures()->getList())->
			set('preview', $subject->getPreview())->
			set('perRow', 4)
	);

?>
				</div>

				<div class="span4 mt20">

					<div class="well">
						<div>
							<h4>
								<?= $subject->getName()?>
								<div class="green">
									<?= ucfirst($subject->getRealtyType()->getName())?>  <?= $subject->getCity() ? ' in '.$subject->getCity()->getName() : null?>
								</div>
							</h4>
						</div>

						<table class="mb10">
<?php
	$group = FeatureTypeGroup::general();
	foreach ($subject->getFeaturesByGroup($group) as $feature) {
?>
						<tr>
							<td align="right"><?= ucfirst($feature->getType()->getName())?> : &nbsp;</td>
							<td><?= $feature->getValue()?></td>
						</tr>
<?php
	}
?>
						</table>

						<table width="100%">
						<tr valign="top">
							<td width="50%">

<?php
	$group = FeatureTypeGroup::indoor();
?>
								<h5 class="green mt20"><?= $group->getName()?></h5>
								<ul>
<?php
	foreach ($subject->getFeaturesByGroup($group) as $feature) {
?>
									<li><?= ucfirst($feature->getType()->getName())?></li>
<?php
	}
?>
								</ul>
							</td>
							<td width="50%">
<?php
	$group = FeatureTypeGroup::outdoor();
?>
								<h5 class="green mt20"><?= $group->getName()?></h5>
								<ul>
<?php
	foreach ($subject->getFeaturesByGroup($group) as $feature) {
?>
									<li><?= ucfirst($feature->getType()->getName())?></li>
<?php
	}
?>
								</ul>
							</td>
						</tr>
						</table>
						
						<? $subject->getText()?>
					</div>

				</div>

			</div>
		</div>

	</div>
