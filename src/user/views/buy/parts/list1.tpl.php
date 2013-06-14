<?php
/**
 *
 */
?>

<div class="span6 mt20">

<?php
	$partViewer->view("$area/parts/menu");
?>

	
<?php
	for ($i = 0; $i < 3; $i ++) {
?>

	<div class="row">
		<div class="span6 list-item">
			<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/port5.jpg">
			<h5>
				<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
			</h5>
			Some details
		</div>
	</div>

	<div class="row">
		<div class="span6 list-item">
			<img src="http://html.orange-idea.com/builder/wp-content/uploads/2012/09/4.jpg">
			<h5>
				<a href="http://html.orange-idea.com/builder/portfolio-type/another-work/" title="Permalink to Another Work">House in Limassol</a>
			</h5>
			Some details
		</div>
	</div>

<?php
	}
?>

</div>