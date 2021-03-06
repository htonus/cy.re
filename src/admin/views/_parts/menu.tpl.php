<?php
/*
 * $Id$
 */

	$menu = array(
		array(
			'title'	=> 'Contents',
			'items'	=> array(
				'language	'	=> 'Language',
				'token'			=> 'Interface texts',
				'custom'		=> 'Custom blocks',
				'staticPage'	=> 'Static pages',
			)
		),
		array(
			'title'	=> 'Realty',
			'items'	=> array(
				'unit'			=> 'Measurement Unit',
				'featureType'	=> 'Feature Type',
				'realtyType'	=> 'Realty Type',
				'country'		=> 'Country',
				'region'		=> 'District',
				'city'			=> 'City',
				'district'		=> 'Municipaty',
				'realty'		=> 'Realty site',
			)
		),
		array(
			'title'	=> 'Articles',
			'items'	=> array(
				'articleCategory'	=> 'Article categories',
				'information'		=> 'Information',
				'project'			=> 'Project',
				'about'				=> 'About Us',
				'news'				=> 'News',
			)
		),
		array(
			'title'	=> 'Users',
			'items'	=> array(
				'resource'	=> 'Resources',
				'group'		=> 'Groups',
				'person'	=> 'Users',
			)
		),
//		'unit'	=> 'Units',
//		'city'	=> 'Cities',
//		'featureType'	=> 'Feature Types',
	);
?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Cyprus-Realty.com</a>
<?php
	if (!empty($user)) {
?>
			<ul class="nav">
				<li><a href="/">Home</a></li>
<?php

		foreach ($menu as $item) {
			if (empty($item['items'])) {
?>
				<li><a href="/index.php?area=<?=$_area?>"><?=$item['title']?></a></li>
<?php
			} else {
?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?=$item['title']?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
<?php		
				foreach ($item['items'] as $_area => $_title) {
?>
						<li><a href="/index.php?area=<?=$_area?>"><?=$_title?></a></li>
<?php
				}
?>
					</ul>
				</li>
<?php

			}
		}
?>
			</ul>
			<ul class="pull-right nav">
				<li><a href="#">Hi, <?=$user->getName()?></a></li>
				<li><a href="/?area=main&action=logout">Sign out?</a></li>
			</ul>
<?php
	}
?>
		</div>
	</div>
</div>
