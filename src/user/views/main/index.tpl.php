<?php
/*
 * $Id$
 */
?>


	<div class="container slogan hidden-phone">
		<div class="row">
			<div class="span12">
				<h3><strong>BUILDER:</strong> Super powerful <span>&amp;</span> responsive wordpress theme with hundreds options.</h3>
			</div>
		</div>
	</div>


	<section>

		<div class="container main">
			<div class="row">

				<div class="span4">
					<div class="catchy">
						<h2><strong>WELCOME!</strong></h2>
						<h5 style="color: #fff;">Your most important message or cacthy phrase goes here and also it goes right here.</h5>
					</div>

					<p class="intro">Simple and flexible HTML, CSS, and Javascript for popular user interface components and interactions.</p>
					<br />

					<form>
<?php
	$partViewer->view('_parts/form/filter');
?>
					</form>

				</div>

				<div class="span8">
<?php
	$partViewer->view(
		'_parts/js', Model::create()->set('name', 'bootstrap-carousel')
	);

	$partViewer->view(
		'_parts/blocks/carousel',
		Model::create()->set('list', $blocks['carousel'])
	);
?>
				</div>

			</div>
		</div>

		<div class="container latest">
			<div class="row">

				<div class="span4">
					<div class="block">
						<h4>
							<img title="round1" src="http://html.orange-idea.com/commander/wp-content/uploads/2012/09/admin.png" alt="" width="25" height="25">
							Powerful Admin Panel
						</h4>
						<div class="clearfix"></div>
						<p>We have built a custom options panel with more then 300 options, that let’s you customize your theme any way you want to!</p>
					</div>
				</div>

				<div class="span4">
					<div class="block">
						<img title="round1" src="http://html.orange-idea.com/commander/wp-content/uploads/2012/09/frame.png" alt="" width="25" height="25" class="pull-left">
						<h4 style="text-align: center;">
							Page Builder Included
						</h4>
						<div class="clearfix"></div>
						<p>Now you’ll be able to create complex layouts within minutes! It’s build on top of the Twitter Bootstrap and jQuery UI frameworks!</p>
					</div>
				</div>

				<div class="span4">
					<div class="block">
						<img title="round1" src="http://html.orange-idea.com/commander/wp-content/uploads/2012/09/ipad.png" alt="" width="25" height="25" class="pull-right">
						<h4>
							Responsive Design
						</h4>
						<div class="clearfix"></div>
						<p>Responsive designs that addapts to smaller devices. Also Builder Theme have 4 loayouts: 2 Boxed and 2 Fullwidth!</p>
					</div>
				</div>

			</div>
		</div>


		<div class="container offers">

			<h3>Recent From Portfolio</h3>

			<div class="row">

				<div class="span3 list-item">
					<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/4.jpg">
					<h5>
						<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
					</h5>
					Some details
				</div>
				<div class="span3 list-item">
					<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/port5.jpg">
					<a href="http://html.orange-idea.com/builder/portfolio-type/cool-ring/" title="Permalink to Cool Ring">
					<h5>
						<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
					</h5>
					Some details
					</a>
				</div>
				<div class="span3 list-item">
					<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/4.jpg">
					<h5>
						<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
					</h5>
					Some details
					</a>
				</div>
				<div class="span3 list-item">
					<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/port5.jpg">
					<h5>
						<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
					</h5>
					Some details
					</a>
				</div>
			</div>

		</div>

		<div class="container extra">
			<div class="row">

				<div class="span6">
					<h3>About Company</h3>
					<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/12/html5.png" class="pull-left">
					<p>Proin dictum erat et purus egestas in gravida leo vestibulum. Praesent rhoncus blandit mauris vitae fringilla. Curabitur tellus erat, ornare et dictum at sed nisi.</p>
					<p><i>Various versions have evolved over the years, sometimes by accident</i></p>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’.</p>

					<a href="#" class="btn"><i class="icon-download"></i> Download our Brochure</a>

					<div class="bloquote">
						<h4>Clients Testimonials</h4>
						<p>
							In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. The readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content.
						</p>
						<i>Mikle / CEO Some Company</i>
					</div>

				</div>

				<div class="span6">
					<h3>Some nice picture carousel</h3>

					<div id="extraCarousel">
						<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/Anchor_v1_preview2-880x461.png"/>
					</div>

					<div class="note">
						<div class="title">
							<div class="date">
								<i class="icon-calendar icon-white"></i>
								17 Apr, 2013
							</div>
							<h4>Post + Right Sidebar</h4>
							<span>BY SOMEONE / 123 COMMENTS /</span>
						</div>

						<p>
							Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget ...
						</p>

						<a href="#"><i class="icon-chevron-right icon-white"></i> Read More</a>
					</div>
				</div>

			</div>
		</div>

	</section>