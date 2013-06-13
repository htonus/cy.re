<?php
	/**
	 * $Id$
	 */

	 $menuList = array(
		 'buy'		=> 'Buy',
		 'rent'		=> 'Rent',
		 'booking'	=> 'Booking',
		 'contact'	=> 'Contacts',
		 'about'	=> 'About Us',
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
						<a href="<?= PATH_WEB?>"><img src="/img/logo2.png" align="left" /></a>
						<i>ESPERIA</i><br/>
						Group of Companies
					</div>
				</div>

				<div class="span3 logo">
					Telephone:  +357 25366144, &nbsp; +357 25369209<br/>
					e-Mail: info@esperiaestates.com<br/>
				</div>

				<div class="span6">

					<div class="visible-phone">
						<select style="width: 100%;" onchange="focument.location.href='<?= PATH_WEB?>' + jq(this).val()">
							<option value="buy">Buy</option>
							<option value="rent">Rent</option>
							<option value="book">Book</option>
							<option value="contact">Contact Us</option>
							<option value="about">About Us</option>
						</select>
					</div>

					<div class="navbar pull-right hidden-phone">
						<ul class="nav">
<?php
	foreach ($menuList as $slag => $title) {
?>
							<li class="<?= $area == $slag ? 'selected' : null?>"><a href="/<?= $slag?>"><?= $title?></a></li>
<?php
	}
?>
						</ul>
					</div>
				</div>

			</div>
		</div>

	</header>