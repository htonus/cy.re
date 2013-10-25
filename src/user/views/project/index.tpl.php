<?php
/*
 * $Id$
 */

	$gradusnik = array();

	$prefix = PATH_WEB.$section->getSlug().'/';
	$model->set('prefix', $prefix);
?>
	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3>
						Projects
					</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="span3 mt20">

					<form action="" method="get">
					<div class="row-fluid">
						<div class="span9"><input type="text" name="search" value="<?= $search?>" class="input-block-level" placeHolder="Search by keyword"/></div>
						<div class="span3"><input type="submit" class="btn btn-submit btn-black" value="_L__SEARCH___" /></div>
					</div>
					</form>

					<div class="clearfix mt20"></div>

				</div>

				<div class="span6 mt20">
<?php
	$partViewer->view("$area/parts/$action");
?>
				</div>

				<div class="span3 mt20">

					<h4>Hot offers</h4>

					<h4 class="mt20">Related links</h4>

				</div>

			</div>
		</div>

	</div>

<script>
jq(document).ready(function(){
	jq('.shortcut').click(function(e){
		var article = jq('[id="'+jq(this).attr('href').match(/[a-z_0-9]+/i)+'"]');
		jq(document).scrollTop(article.offset().top - 70);
		e.preventDefault();
	});
});
</script>
