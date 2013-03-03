<?php
	$list = array(
		'language'	=> 'Language',
		'unit'		=> 'Measurement Unit',
		'featureType'	=> 'Property Feature Type',
		'realtyType'	=> 'Type of the Realty',
		'city'		=> 'Citiy'
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