<?php
	$list = array(
		'unit'			=> 'Measurement Unit',
		'featureType'	=> 'Feature Type',
		'realtyType'	=> 'Realty Type',
		'country'		=> 'Country',
		'region'		=> 'District',
		'city'			=> 'City',
		'district'		=> 'Municipaty',
		'realty'		=> 'Realty site',
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