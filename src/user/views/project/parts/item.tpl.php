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
			set('title', '_S__PROJECTS___')->
			set('subtitle', null)
	);

	$pictureList = $article->getPictures()->getList();
	$preview = reset($pictureList);
?>
<script type="text/javascript">
var PER_ROW = 3;
var PER_PAGE = 2;
var ROW_HEIGHT = <?= PictureSize::preview()->getHeight()?> + 20;

jq(document)
	.ready(function(){
		showPreview(jq('#preview_<?= $preview->getId()?> IMG'));

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

				<div class="span6 mt20">

					<div class="well">
						<div>
							<h4><?= $article->getName()?></h4>
						</div>

						<div class="green">
							<?= $article->getBrief()?>
						</div>

					</div>

					<?= $article->getText()?>

					<div class="clearfix"></div>
					<div class="pull-right green mt20"><?= $article->getPublished()->toDate()?></div>

				</div>

				<div class="span6 mt20">
					<div class="carousel-inner bigimage mb20" id="picture_<?= $preview->getId()?>">
						<img src="<?= PictureSize::list1()->getUrl($preview)?>" width="<?= PictureSize::big()->getWidth(); ?>" height="<?= PictureSize::big()->getHeight(); ?>" alt="" >
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
	$previewSize = PictureSize::preview();
	foreach ($pictureList as $item) {
?>
						<div class="span2 mb20" id="preview_<?= $item->getId()?>">
							<img src="<?= $previewSize->getUrl($item)?>" width="<?= $previewSize->getWidth(); ?>" height="<?= $previewSize->getHeight(); ?>" alt="" class="preview" >
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

			</div>
		</div>

	</section>
