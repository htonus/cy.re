<?php
/*
 * $Id$
 */

	$menu = array(
		array(
			'title'	=> 'Edit Dictionaries',
			'items'	=> array(
				'language	'	=> 'Language',
				'unit'			=> 'Measurement unit',
				'featureType'	=> 'Property Feature Type',
				'realtyType'	=> 'Type of the realty',
				'city'			=> 'City',
				'district'		=> 'District',
			)
		),
		array(
			'title'	=> 'User management',
			'items'	=> array(
				'resource'	=> 'Resources',
				'group'		=> 'Groups',
				'person'	=> 'Users',
			)
		),
		array(
			'title'	=> 'Objects',
			'items'	=> array(
				'realty'	=> 'Realty Sites',
				'article'	=> 'Articles',
				'news'		=> 'News',
			)
		),
//		'unit'	=> 'Units',
//		'city'	=> 'Cities',
//		'featureType'	=> 'Feature Types',
//		'property'		=> 'Properties to Offer',
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
