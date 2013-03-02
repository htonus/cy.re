<?php
	$list = array(
		'language'	=> 'Languages',
		'unit'		=> 'Measurement Units',
		'featureType'	=> 'Property Feature Types',
		'realtyType'	=> 'Types of the realty',
	);

?>

<ul class="nav nav-list bs-docs-sidenav affix-top">
<?php
	foreach ($list as $key => $value) {

?>
	<li class="<?= $key==$area ? 'active' : ''?>"><a href="/index.php?area=<?=$key?>"><i class="icon-chevron-right"></i> <?=$value?></a></li>
<?php
	}
?>
</ul>