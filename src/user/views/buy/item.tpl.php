<?php
/*
 * $Id$
 */

	$partViewer->view('_parts/page_title');

?>
<script type="text/javascript">
jq(document).ready(function(){
	dimPreview(jq('#preview_<?= $subject->getPreview()->getId()?>'));

	jq('.preview').click(function(){
		var src = jq('#picture').attr('src').replace(/[^\/]+$/, jq(this).attr('src').match(/[^\/]+$/));

		if (src == jq('#picture').attr('src'))
			return;
		
		jq('#picture').animate({opacity: 0});
		jq('#picture').attr('src', src);
		jq('#picture').load(function(){
			jq('#picture').stop().animate({opacity: 1});
		});
		
		jq('.preview').parent().css('background', "none");
		jq('.preview').css({opacity: 1});

		dimPreview(jq(this));
	});
});

function dimPreview(jqObject)
{
	jqObject.parent().css('background', "#000");
	jqObject.animate({opacity: 0.5});
}
</script>

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