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
						<img src="/img/logo1.png"/>
					</div>
				</div>

				<div class="span9">

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