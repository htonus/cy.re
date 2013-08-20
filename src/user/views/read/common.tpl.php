<?php
/*
 * $Id$
 */
	
	$gradusnik = array();
	
	if ($category) {
		$item = $category;
		while($item = $item->getParent()) {
			$gradusnik[$item->getWebSlug()] = $item->getName();
		}
	}
	
	$prefix = PATH_WEB.Section::read()->getSlug().'/';
	$model->set('prefix', $prefix);
?>
	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h3>
<?php
	if ($category) {
?>
						Section <strong>:</strong> <?= $category->getName()?>
<?php
	} else {
?>
						Choose section to explore
<?php
	}
?>
					</h3>
					
<?php
	if ($category) {
?>
					<div class="gradus">
						<a class="subpage_block" href="<?= $prefix?>">Home</a> / 
<?php
	if (!empty($gradusnik)) {
		
		foreach ($gradusnik as $slug => $name) {
?>
			<a class="subpage_block" href="<?= $prefix.$slug?>"><?= $name?></a> / 
<?php
		}
	}
?>
						<span><?= $category->getName()?></span>
					</div>
<?php
	}
?>
				</div>
			</div>
		</div>
	</div>

	<section>

		<div class="container">
			<div class="row">
				<div class="span3 mt20">
					<h4>Sections</h4>
					<ul>
<?php
	foreach ($categoryList as $item) {
?>
						<li>
							<a href="<?= $prefix.$item->getWebSlug()?>">
								<strong><?= $item->getName()?></strong>
								<p class="black mb10"><?= $item->getText()?></p>
							</a>
						</li>
<?php
	}
?>
					</ul>
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

	</section>
<script>
jq(document).ready(function(){
	jq('.shortcut').click(function(e){
		var article = jq('[id="'+jq(this).attr('href').match(/[a-z_0-9]+/i)+'"]');
		jq(document).scrollTop(article.offset().top - 70);
		e.preventDefault();
	});
});
</script>
