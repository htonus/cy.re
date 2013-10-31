<?php
/*
 * $Id$
 */
?>
                                        <h3>_S__PROJECTS___</h3>
<?php
        if (empty($list)) {
                echo '_S__NO PROJECTS___';
        } else {
                if ($search) {
?>
                                        <div class="well well-small">_S__FOUND_BY_KEYWORD___ <b><?= $search ?></b> <?= $pager->get('total') ?></div>
<?php
                }
?>
                                        <ul>
<?php
                foreach ($list as $item) {
                        echo '<li><a href="#article_'.$item->getId().'" class="shortcut">'.$item->getName().'</a></li>';
                }
?>
                                        </ul>
<?php
                $articleUrlPrefix = PATH_WEB.$section->getSlug().'/item/';
                
                foreach ($list as $item) {
?>
                                        <div class="clearfix"></div>
                                        <div class="mt50" id="article_<?= $item->getId() ?>">
                                                <a href="<?= $articleUrlPrefix.$item->getId() ?>">
                                                        <h4><?= $item->getName()?></h4>
                                                        <p class="black"><?= $item->getBrief()?></p>
                                                        <p class="pull-left"><b>Published</b>: <?= $item->getPublished()->toDate()?></p>
                                                        <p class="pull-right"><b>Read more &gt;&gt;&gt;</b></p>
                                                </a>
                                        </div>
<?php
                }
        }
?>

<script type="text/javascript">
jq(document).ready(function(){
        jq('.shortcut').click(function(e){
                var article = jq('[id="'+jq(this).attr('href').match(/[a-z_0-9]+/i)+'"]');
                jq(document).scrollTop(article.offset().top - 70);
                e.preventDefault();
        });
});
</script>
