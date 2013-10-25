<?php
	/**
	 * $Id$
	 */

	 $menuList = array(
		 'buy'		=> '_S__BUY___',
		 'rent'		=> '_S__RENT___',
		 'booking'	=> '_S__BOOKING___',
		 'read'		=> '_S__READ___',
		 'about'	=> '_S__ABOUT___',
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
						<select style="width: 100%;" onchange="focument.location.href='<?= PATH_WEB?>' + jq(this).val()">
<?php
	foreach (Section::getMenuList() as $item) {
?>
							<option value="<?= $item->getSlug() ?>"><?= $item->getName() ?></option>
<?php
	}
?>
						</select>
					</div>

					<div class="navbar pull-right hidden-phone">
						<ul class="nav" style="margin: 0px;">
<?php
	foreach (Section::getMenuList() as $item) {
?>
							<li class="<?= $area == $item->getSlug() ? 'selected' : null ?>" id="section_<?= ucfirst($item->getId()) ?>"><a href="/<?= $item->getSlug() ?>"><?= $item->getName()?></a></li>
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
					<div class="row">
<?php
	foreach ($categoryList as $item) {
		if ($item->getParentId())
			continue;
		
		$categoryUrl = PATH_WEB
			.Section::info()->getSlug().'/'
			.($item->getSlug() ? $item->getSlug() : $item->getId());
?>
						<div class="span3">
							<a href="<?= $categoryUrl; ?>">
								<h5><?= $item->getName()?></h5>
								<?= $item->getText()?>
							</a>
						</div>
<?php
	}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
var hideInterval = 0;

jq(document).ready(function(){
	jq('#section_<?= Section::INFO ?>, .submenu .inner')
		.mouseover(doMouseOver)
		.mouseout(doMouseOut);
});
function doMouseOver()
{
	jq('.submenu').fadeIn();
	if (hideInterval > 0) {
		clearInterval(hideInterval);
		hideInterval = 0;
	}
	jq('#section_<?= Section::INFO ?>').addClass('hover');
}
function doMouseOut()
{
	hideInterval = setInterval('jq("#toRead").removeClass("hover"); jq(".submenu").fadeOut();', 300);
}
</script>