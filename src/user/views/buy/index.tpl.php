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
		Model::create()->
			set('list', $blocks[CustomType::CAROUSEL])->
			set('area', $area)
	);
?>
				</div>

			</div>
		</div>


<?php
	
	$partViewer->view(
		'_parts/blocks/latest',
		Model::create()->
			set('list', empty($latestList) ? array() : $latestList)
	);
	
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
