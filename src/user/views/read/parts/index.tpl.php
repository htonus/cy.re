<?php
/*
 * $Id$
 */
?>
					<h4>Articles</h4>
<?php
	if (empty($list)) {
					echo 'No articles in the Section.';
	} else {
?>
					<ul>
<?php
		foreach ($list as $item) {
			echo '<li><a href="#article_'.$item->getId().'" class="shortcut">'.$item->getName().'</a></li>';
		}
?>
					</ul>
<?php
		$articleUrlPrefix = PATH_WEB.Section::read()->getSlug().'/article/';
		
		foreach ($list as $item) {
?>
					<div class="mt20" id="article_<?= $item->getId() ?>">
						<a href="<?= $articleUrlPrefix.$item->getId() ?>">
							<h4><?= $item->getName()?></h4>
							<p class="black"><?= $item->getBrief()?></p>
							<p class="pull-left"><b>Published</b>: <?= $item->getPublished()->toString()?></p>
							<p class="pull-right"><b>Read more &gt;&gt;&gt;</b></p>
						</a>
					</div>
<?php
		}
	}
?>

<script>
jq(document).ready(function(){
	jq('.shortcut').click(function(e){
		var article = jq('[id="'+jq(this).attr('href').match(/[a-z_0-9]+/i)+'"]');
		jq(document).scrollTop(article.offset().top - 70);
		e.preventDefault();
	});
});
</script>
