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
<script type="text/javascript">
var PER_ROW = 4;
var PER_PAGE = 2;
var ROW_HEIGHT = <?= PictureSize::preview()->getHeight()?> + 20;

jq(document)
	.ready(function(){
		showPreview(jq('#preview_<?= $subject->getPreview()->getId()?> IMG'));

		jq('.preview').click(function(){
			showPreview(jq(this));
		});

		jq('.carousel-control').click(function(){
			showPreviewItem(jq(this).hasClass('right'));
		});

		jq('#previewList').mousewheel(function(e, way, dX, dY) {
			scrollPreviewList(dY);
			return false; // prevent default
		});

		jq('.big_up').click(function(){
			scrollPreviewList(1);
		});
		jq('.big_down').click(function(){
			scrollPreviewList(-1);
		});
	})
	.keydown(function(e){
		switch(e.keyCode) {
			case 39: showPreviewItem(true);		break;
			case 37: showPreviewItem(false);	break;
			case 40: scrollPreviewList(-1);		break;
			case 38: scrollPreviewList(1);		break;
			default: return true;
		}

		e.preventDefault();
		e.stopPropagation();
		return false;
	});

function scrollPreviewList(delta)
{
	if (jq('#previewList > DIV').is(':animated'))
		return false;

	var marginTop = parseInt(jq('#previewList > DIV').css('margin-top'))
		+ delta * ROW_HEIGHT;

	var maxScroll = (PER_PAGE - Math.ceil(jq('#previewList > DIV > DIV').size() / PER_ROW))
		* ROW_HEIGHT;
	
	jq('.big_down > DIV, .big_up > DIV').removeClass('inactive');

	if (marginTop >= 0) {
		marginTop = 0;
		jq('.big_up > DIV').addClass('inactive');
	} else if (marginTop <= maxScroll) {
		marginTop = maxScroll;
		jq('.big_down > DIV').addClass('inactive');
	}

	jq('#previewList > DIV').animate({'margin-top': marginTop}, 'fast');
}

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

	showPreview(jq('.preview', item));
}

function showPreview(preview)
{
	var image = jq('.bigimage IMG');

	var src = image.attr('src').replace(/[^\/]+$/, jq(preview).attr('src').match(/[^\/]+$/));

	if (src != image.attr('src')) {
		image.animate({opacity: 0});
		image.attr('src', src);
		image.parent().attr('id', 'picture_' + preview.parent().attr('id').match(/\d+/));
		image.load(function(){
			image.stop().animate({opacity: 1});
		});
	}
	
	jq('.preview').parent().css('background', "none");
	jq('.preview').css({opacity: 1});

	var diff = parseInt(jq('#previewList > DIV').css('margin-top'))
		 + Math.floor(preview.parent().index() / PER_ROW) * ROW_HEIGHT

	if (diff != 0)
		scrollPreviewList(- diff / ROW_HEIGHT);
	
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
					<div class="carousel-inner bigimage mb20" id="picture_<?= $subject->getPreviewId()?>">
						<img src="<?= PictureSize::big()->getUrl($subject->getPreview())?>" />
						<a class="left carousel-control" href="#prevPreviev">‹</a>
						<a class="right carousel-control" href="#nextPreview">›</a>
					</div>
<?php
	if (count($pictureList) > 8) {
?>
					<div align="center" class="big_up mb20"><div></div></div>
<?php
	}
?>

					<div class="row hidden-phone mb20" id="previewList">
						<div>
<?php
	foreach ($pictureList as $item) {
?>
						<div class="span2 mb20" id="preview_<?= $item->getId()?>">
							<img src="<?= PictureSize::preview()->getUrl($item)?>" class="preview" />
						</div>
<?php
	}
?>
						</div>
					</div>
					
<?php
	if (count($pictureList) > 8) {
?>
					<div align="center" class="big_down mb20"><div></div></div>
<?php
	}
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

	</section>
