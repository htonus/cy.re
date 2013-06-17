<?php
/*
 * $Id$
 */

$address = <<<ADDRESS
246 Archbishop Makarios Avenue, Salamis Court,<br />
P.O.Box 54100,<br />
3720 Limassol, Cyprus<br />
ADDRESS;

?>
	<footer>

		<div class="twitter hidden-phone">
			<div class="container">
				<div class="row">

					<div class="span3">
						<h5 class="white">___TTL-TWITTER-FEED___</h5>
						Find out what's happening, right now, with the people and organizations you care about.
					</div>

					<div class="span9">
						<div class="note">
							Check out this great item <span>#gallery</span> <span>#green</span> template "QARK Modern - HTML Template" <span>http://t.co/IUMXKNWCVv</span>
							<br />
							<span>about 12 minutes ago</span>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="social">
			<div class="container">
				<div class="row">

					<div class="span2">
						<h3 class="white">___TTL-FOLLOW-US___</h3>
						<a href="https://plus.google.com" rel="nofollow publisher" target="_blank"><i class="ico-google"></i></a>
						<a href="http://www.facebook.com" rel="nofollow" target="_blank"><i class="ico-fb"></i></a>
						<a href="http://cy.linkedin.com" rel="nofollow" target="_blank"><i class="ico-linkdin"></i></a>
						<a href="https://twitter.com" rel="nofollow" target="_blank"><i class="ico-twitter"></i></a>
					</div>

					<div class="span4 hidden-phone">
						<div class="note">
							<h5>___TTL-ESPERIA-COMPANY___</h5>
							<p>___ESPERIA-COMPANY___</p>
						</div>
					</div>

					<div class="span3">
						<h5 class="underline">___TTL-LEGAL-INFO___</h5>
						<a class="icon-briefcase icon-white pull-left mr10"></a>
						<p class="pull-left">
							<a href="#">Hello world!</a><br />
							Dec 1, 2012 / 3 Comments
						</p>
						<div class="clearfix"></div>
						<a class="icon-briefcase icon-white pull-left mr10"></a>
						<p class="pull-left">
							<a href="#">Hello world!</a><br />
							Dec 1, 2012 / 3 Comments
						</p>
						<div class="clearfix"></div>
					</div>

					<div class="span3">
						<h5 class="underline">___TTL-CONTACT-INFO___</h5>
						<ul class="unstyled">
							<li title="Telephone"><i class="icon-user icon-white"></i>
								<?= empty($static[StaticType::PHONE]) ? '+357 25366144, FAX +357 25369209' : $static[StaticType::PHONE]->getName(); ?>
							</li>
							<li title="e-Mail"><i class="icon-envelope icon-white"></i> 
								<a href="mailto:info@esperiaestates.com"><?= empty($static[StaticType::EMAIL]) ? 'info@esperiaestates.com' : $static[StaticType::EMAIL]->getName(); ?></a>
							</li>
							<li title="Adddress">
								<i class="icon-home icon-white"></i> Head office:<br />
								<div style="line-height: 12px;">
									<?= empty($static[StaticType::ADDRESS]) ? $address : $static[StaticType::ADDRESS]->getAnons(); ?>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">

					<div class="span6">
						Copyright 2012 &copy; Esperia Group of Companies
					</div>

					<div class="span6 hidden-phone">
						<div class="pull-right">
							<a href="/buy">_S__BUY___</a> / <a href="/rent">_S__RENT___</a> / <a href="/book">_S__BOOKING___</a> / <a href="/contact">_S__CONTACTS___</a> / <a href="/about">_S__ABOUT-US___</a>
						</div>
					</div>

				</div>
			</div>
		</div>

	</footer>

