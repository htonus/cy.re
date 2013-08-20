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
	<header>

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

				<div class="span3">
					<div class="logo">
						_S__TELEPHONE___:  +357 25366144, &nbsp; +357 25369209<br/>
						_S__EMAIL___: info@esperiaestates.com<br/>
					</div>
				</div>

				<div class="span6">

					<div class="visible-phone">
						<select style="width: 100%;" onchange="focument.location.href='<?= PATH_WEB?>' + jq(this).val()">
							<option value="buy">_S__BUY___</option>
							<option value="rent">_S__RENT___</option>
							<option value="read">_S__READ___</option>
							<option value="abount">_S__ABOUT___</option>
						</select>
					</div>

					<div class="navbar pull-right hidden-phone">
						<ul class="nav" style="margin: 0px;">
							<li class="<?= $area == 'buy' ? 'selected' : null?>"><a href="/buy">_S__BUY___</a></li>
							<li class="<?= $area == 'rent' ? 'selected' : null?>"><a href="/rent">_S__RENT___</a></li>
							<li class="<?= $area == 'read' ? 'selected' : null?>" id="toRead"><a href="#">_S__READ___</a></li>
							<li class="<?= $area == 'abount' ? 'selected' : null?>"><a href="/about">_S__ABOUT___</a></li>
						</ul>
					</div>
					
				</div>

			</div>
		</div>

	</header>
	
	<div class="submenu hide">
		<div class="container">
			<div class="row">
				<div class="offset6 span6 inner">
					<div class="row">
<?php
	foreach ($categoryList as $item) {
		if ($item->getParentId())
			continue;
?>
						<div class="span3">
							<a href="">
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
	jq('#toRead')
		.mouseover(doMouseOver)
		.mouseout(doMouseOut);
		
	jq('.submenu')
		.mouseover(doMouseOver)
		.mouseout(doMouseOut);
});
function doMouseOver()
{
	jq('.submenu').slideDown();
	if (hideInterval > 0) {
		clearInterval(hideInterval);
		hideInterval = 0;
	}
	jq('#toRead').addClass('li_hover');
	jq('#toRead A').addClass('a_hover');
}
function doMouseOut()
{
	hideInterval = setInterval('jq(".submenu").slideUp(switchHover);', 300);
}
function switchHover()
{
	jq('#toRead').removeClass('li_hover');
	jq('#toRead A').removeClass('a_hover');
}
</script>