<?php
/*
 * $Id$
 */

	$menu = array(
		array(
			'title'	=> 'Dictionaries',
			'items'	=> array(
				'language'	=> 'Languages',
				'unit'		=> 'Measurement units',
				'featureType'	=> 'Property Feature Types',
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
		</div>
	</div>
</div>
