<?php
	/**
	 * $Id$
	 */

	$submenuList = array(
		Section::RENT	=> array(),
		Section::INFO	=> array(),
	);
	
	foreach ($categoryList as $item) {
		if ($item->getParentId())
			continue;
		
		$categoryUrl = Section::info()->getSlug().'/'
			.($item->getSlug() ? $item->getSlug() : $item->getId());
		
		$submenuList[Section::INFO][$categoryUrl] =
			"<h5>{$item->getName()}</h5>{$item->getText()}";
	}
	
	$submenuList[Section::RENT] = array(
		'rent'		=> '<H5>___RENT___</H5>',
		'dailyrent'	=> '<H5>___DAILY-RENT___</H5>',
	);
?>
	<div class="header">

		<div class="hr">
			<div class="h_2"></div>
		</div>

		<div class="container">

			<div class="row">

				<div class="span3">
					<div class="logo">
						<a href="<?= PATH_WEB?>">
							<img src="/img/logo2.png" align="left" />
							<i>ESPERIA</i><br/>
							Group of Companies
						</a>
					</div>
				</div>

				<div class="span9">

					<div class="visible-phone">
						<select style="width: 100%;" onchange="document.location.href='<?= PATH_WEB?>' + jq(this).val()">
<?php
	$menuList = MenuHelper::getMenuList();
	foreach ($menuList as $item) {
?>
							<option value="<?= $item->getSlug() ?>"<?= $section->getSlug() == $item->getSlug() ? ' selected="selected"' : null ?>><?= $item->getName() ?></option>
<?php
		if (MenuHelper::hasSubMenu($item)) {
			foreach ($submenuList[$item->getId()] as $url => $title) {
?>
							<option value="<?= $url ?>"> &nbsp; <?= strip_tags($title) ?></option>
<?php
			}
		}
	}
?>
						</select>
					</div>

					<div class="navbar pull-right hidden-phone">
						<ul class="nav" style="margin: 0px;">
<?php
	foreach ($menuList as $item) {
?>
							<li class="<?= MenuHelper::hasSubMenu($item) ? 'smenu' : null; ?> <?= $section->getSlug() == $item->getSlug() ? 'selected' : null ?>" id="section_<?= ucfirst($item->getId()) ?>"><a href="/<?= $item->getSlug() ?>"><?= $item->getName()?></a></li>
<?php
	}
?>
						</ul>
					</div>
					
				</div>

			</div>
		</div>

	</div>
	
	<div class="submenu hide">
		<div class="container">
			<div class="row">
				<div class="offset6 span6 inner">
<?php
	foreach ($submenuList as $sectionId => $submenu) {
?>
					<div class="row hide" id="sub_<?= $sectionId ?>">
<?php
		foreach ($submenu as $url => $title) {
?>
						<div class="span3">
							<a href="<?= PATH_WEB_USER.$url; ?>"><?= $title ?></a>
						</div>
<?php
		}
?>
					</div>
<?php
	}
?>

				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
var hideInterval = 0;

jq(document).ready(function(){
	jq('.smenu')
		.mouseover(function(){
			doMouseOver('' + jq(this).attr('id').match(/\d+/));
		})
		.mouseout(function(){
			doMouseOut('' + jq(this).attr('id').match(/\d+/));
		});
	jq('.submenu .inner .row')
		.mouseover(function(){
			doMouseOver('' + jq('.active', jq(this).parent()).attr('id').match(/\d+/));
		})
		.mouseout(function(){
			doMouseOut('' + jq('.active', jq(this).parent()).attr('id').match(/\d+/));
		});
});
function doMouseOver(sectionId)
{
	jq('.submenu').fadeIn();
	if (hideInterval > 0) {
		clearInterval(hideInterval);
		hideInterval = 0;
	}
	jq('.submenu .inner .row').removeClass('active').addClass('hide');
	jq('.submenu .inner #sub_' + sectionId).removeClass('hide').addClass('active');
	jq('.smenu').removeClass('hover');
	jq('#section_' + sectionId).addClass('hover');
}
function doMouseOut(sectionId)
{
	hideInterval = setInterval('jq("#section_' + sectionId + '").removeClass("hover"); jq(".submenu").fadeOut();', 300);
}
</script>