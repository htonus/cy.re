<?php
/**
 *
 */
?>

<div class="span6 mt20">

	<div class="row">
		<div class="span6">
			<a href="#" class="btn btn-small btn-black active">List</a>
			<a href="#" class="btn btn-small btn-black">2-column</a>
			<a href="#" class="btn btn-small btn-black">4-column</a>
		</div>
	</div>

	<br/>
	
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