<?php
	$list = array(
		'language'		=> 'Language',
		'token'			=> 'Interface texts',
		'custom'		=> 'Custom blocks',
		'staticPage'	=> 'Static pages',
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