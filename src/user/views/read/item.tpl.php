<?php
/*
 * $Id$
 */

	$gradusnik = array();
	
	if ($category) {
		$item = $category;
		while($item = $item->getParent()) {
			$gradusnik[$item->getWebSlug()] = $item->getName();
		}
	}
	
	$prefix = PATH_WEB.Section::read()->getSlug().'/';
?>
	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3><?= $article->getName()?></h3>
					
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


	<section>

		<div class="container">
			<div class="row">

				<div class="span8 mt20">

					<img src="<?= PictureSize::big()->getUrl($subject->getPreview())?>" id="picture" />

					<div class="row hidden-phone">
<?php
	foreach ($subject->getPictures()->getList() as $item) {
?>
						<div class="span2 mt20">
							<img src="<?= PictureSize::preview()->getUrl($item)?>" class="preview" id="preview_<?= $item->getId()?>" />
						</div>
<?php
	}
?>
					</div>

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
						
						<?= $subject->getText()?>
					</div>

				</div>

			</div>
		</div>

	</section>
