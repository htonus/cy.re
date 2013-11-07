<?php
/*
 * $Id$
 */

	if (
		!($longitude = $subject->getLongitude())
		|| !($latitude = $subject->getLatitude())
	)
		return;

	$delta = 20;
	$zoom = 15;

	if (!$user->isAdmin()) {
		$longitude += rand(-$delta, $delta) / $delta / 500;
		$latitude += rand(-$delta, $delta) / $delta / 500;
	}
?>

<!-- button type="button" class="btn btn-small btn-black" onclick="jq('.bigimage IMG').attr('src', 'http://maps.googleapis.com/maps/api/staticmap?zoom=< ?= $zoom ? >&size=650x450&sensor=false&center=< ?= $longitude ? >, < ?= $latitude ? >')">_S__SEE ON MAP___</button -->


<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDqJzotMc4rSGxKv6JHxDK6wQYLhdJiR_Y&sensor=false"></script>

<script type="text/javascript">
function openMap()
{
	if (jq('#googleMap').size() < 1) {
		jq('.bigimage').append('<div id="googleMap"></div>');
		jq('#googleMap').css({
				'position'	: 'absolute'
			,	top			: 0
			,	left		: 0
			,	right		: 0
			,	bottom		: 0
		});
	}
	
	var mapProp = {
		center		: new google.maps.LatLng(<?= $latitude ?>, <?= $longitude ?>)
	,	zoom		: <?= $zoom ?>
	,	mapTypeId	: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
}
</script>

<button type="button" class="btn btn-small btn-black" onclick="openMap()">_S__SEE ON MAP___</button>
