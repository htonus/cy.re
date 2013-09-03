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

?>
<script type="text/javascript">
jq(document).ready(function(){
	dimPreview(jq('#preview_<?= $subject->getPreview()->getId()?> IMG'));

	jq('.preview').click(function(){
		showPreview(jq(this));
	});
	
	jq('.carousel-control').click(function(){
		showPreviewItem(jq(this).hasClass('right'));
	});
})
.keyup(function(e){
	if (e.keyCode == 39) {
		showPreviewItem(true);
	} else if (e.keyCode == 37) {
		showPreviewItem(false);
	}
});

function showPreviewItem(next)
{
	var inList = jq('#preview_' + jq('.bigimage').attr('id').match(/\d+/));
	var item = null;

	if (next) {
		item = inList.next();
		if (!item.size())
			item = inList.parent().find('DIV:first-child');
	} else {
		item = inList.prev();
		if (!item.size())
			item = inList.parent().find('DIV:last-child');
	}

	return showPreview(jq('.preview', item));
}

function showPreview(preview)
{
	var image = jq('.bigimage IMG');

	var src = image.attr('src').replace(/[^\/]+$/, jq(preview).attr('src').match(/[^\/]+$/));

	if (src == image.attr('src'))
		return;

	image.animate({opacity: 0});
	image.attr('src', src);
	image.parent().attr('id', 'picture_' + preview.parent().attr('id').match(/\d+/));
	image.load(function(){
		image.stop().animate({opacity: 1});
	});

	jq('.preview').parent().css('background', "none");
	jq('.preview').css({opacity: 1});

	dimPreview(preview);
}


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
					<div class="carousel-inner bigimage" id="picture_<?= $subject->getPreviewId()?>">
						<img src="<?= PictureSize::big()->getUrl($subject->getPreview())?>" />
						<a class="left carousel-control" href="#prevPreviev">‹</a>
						<a class="right carousel-control" href="#nextPreview">›</a>
					</div>
					<div class="row hidden-phone" id="previewList">
<?php
	foreach ($subject->getPictures()->getList() as $item) {
?>
						<div class="span2 mt20" id="preview_<?= $item->getId()?>">
							<img src="<?= PictureSize::preview()->getUrl($item)?>" class="preview" />
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
						
						<? $subject->getText()?>
					</div>

				</div>

			</div>
		</div>

	</section>
