<?php
/*
 * $Id$
 */
?>

	<section>

		<div class="container main">
			<div class="row">

				<div class="span4">
					<div class="catchy">
						<div class="pull-right white" style="text-align: right"><b>Register</b><br>Forgot password</div>
						<h2><strong>WELCOME</strong></h2>
						<div class="row-fluid form-inline">
							<div class="span6"><input type="text" name="username" class="input-block-level" /></div>
							<div class="span3"><input type="password" name="userpass" class="input-block-level" /></div>
							<div class="span3"><a href="#" class="btn input-block-level">Submit</a></div>
						</div>
						<div class="row-fluid">
							<div class="span6 white">User name</div>
							<div class="span3 white">Password</div>
							<div class="span3 white"></div>
						</div>
					</div>

					<p class="intro">Simple and flexible HTML, CSS, and Javascript for popular user interface components and interactions.</p>
					<br />

					<form action="/<?= $area?>/list" method="get">
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
		Model::create()->set('list', $blocks[CustomType::CAROUSEL])
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


<?php
	$partViewer->view(
		'_parts/blocks/recent',
		Model::create()->
			set('area', $area)->
			set('list', $blocks[CustomType::RECENT])
	);
	
	$partViewer->view(
		'_parts/blocks/about',
		Model::create()->
			set('area', $area)->
			set('item', $static[StaticType::COMPANY])
	);
?>

	</section>