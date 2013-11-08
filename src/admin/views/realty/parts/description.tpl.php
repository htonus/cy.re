<?php
/**
 * $Id$
 */
?>

<div class="row-fluid">

	<div class="span6">

		<div class="control-group">
			<label class="control-label" for="input_realtyType">Realty Type</label>
			<div class="controls">
				<select name="realtyType" id="input_realtyType">
<?php
	$default = $form->getValue('realtyType')
		? $form->getValue('realtyType')->getId()
		: null;

	foreach ($realtyTypeList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?=$item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_longitude">Plot on map</label>
			<div class="controls">
				<input type="checkbox" name="polygon" value="<?= $form->getValue('polygon') ?>" <?= $form->getValue('polygon') ? 'checked="checked"' : null?> />
				<input type="button" id="setLocation" value="Choose on Map" class="btn btn-warning btn-small" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input_latitude">Latitude</label>
			<div class="controls">
				<input type="text" id="input_latitude" placeholder="latitude" name="latitude" value="<?= $form->getValue('latitude')?>" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input_longitude">Longitude</label>
			<div class="controls">
				<input type="text" id="input_longitude" placeholder="longitude" name="longitude" value="<?= $form->getValue('longitude')?>" />
			</div>
		</div>

	</div>

	
	
	
	
	<div class="span6">

		<div class="control-group">
			<label class="control-label" for="input_country">Country</label>
			<div class="controls">
				<select name="country" id="input_country" style="background-color: #EFE;">
					<option value=""></option>
<?php
	$default = $form->getValue('city')
		? $form->getValue('city')->getCountryId()
		: null;

	foreach ($countryList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input_region">District</label>
			<div class="controls">
				<select name="region" id="input_region" style="background-color: #EFE;">
					<option value=""></option>
<?php
	$default = $form->getValue('city')
		? $form->getValue('city')->getRegionId()
		: null;

	foreach ($regionList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input_city">City</label>
			<div class="controls">
				<select name="city" id="input_city">
					<option value=""></option>
<?php
	$default = $form->getValue('city')
		? $form->getValue('city')->getId()
		: null;

	foreach ($cityList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input_district">Municipality</label>
			<div class="controls">
				<select name="district" id="input_district">
					<option value=""></option>
<?php
	$default = $form->getValue('district')
		? $form->getValue('district')->getId()
		: null;

	foreach ($districtList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input_zip">ZIP (Post Code)</label>
			<div class="controls">
				<input type="text" id="input_zip" placeholder="ZIP (Post Code)" name="zip" value="<?= $form->getValue('zip')?>" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="input_address">Address</label>
			<div class="controls">
				<input type="text" id="input_address" placeholder="Address" name="address" value="<?= $form->getValue('address')?>" />
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
jq(document).ready(function(){
	
	jq('#input_country, #input_region, #input_city').change(function(){
		var countryId = regionId = cityId = null;
		
		if (jq(this).attr('id').match(/country/)) {
			jq('#input_region OPTION, #input_city OPTION, #input_district OPTION').remove();
			countryId = jq(this).val();
		}
		
		if (jq(this).attr('id').match(/region/)) {
			jq('#input_city OPTION, #input_district OPTION').remove();
			regionId = jq(this).val();
		}
		
		if (jq(this).attr('id').match(/city/)) {
			jq('#input_district OPTION').remove();
			cityId = jq(this).val();
		}
		
		jq.getJSON(
			'<?= PATH_WEB_ADMIN?>?area=city&action=list',
			{
				country	: countryId
			,	region	: regionId
			,	city	: cityId
			},
			function(data){
				if (typeof data.regionList != 'undefined')
					updateSelector('region', data.regionList);
				if (typeof data.cityList != 'undefined')
					updateSelector('city', data.cityList);
				if (typeof data.districtList != 'undefined')
					updateSelector('district', data.districtList);
			}
		);
	});
	
	jq('#input_city').change(function(){
		jq('#input_district OPTION').remove();

		jq.getJSON(
			'/?area=district&action=list&city=' + jq(this).val(),
			function(data){
				var districtSelector = jq('#input_district')
				districtSelector.append('<option value=""></option>');

				if (typeof data.districtList != undefined) {
					var list = data.districtList;

					for (id in list) {
						districtSelector.append('<option value="' + id + '">' + list[id] + '</option>');
					}
				}
			}
		)
	});
});

function updateSelector(name, list)
{
	var selector = jq('#input_' + name);
	var selected = false;
	
	jq('OPTIONS', selector).remove();
	
	if (list.length > 1) {
		selector.append('<option value=""></option>');
	} else if (list.length == 1) {
		selected = ' selected="selected"';
	}
	
	for (var id in list)
		selector.append('<option value="' + id + '"' + selected + '>' + list[id] + '</option>');
}
</script>

<?php

	$model->set('editorFor', 'text');
	$partViewer->view('_parts/form/i18n');

?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=drawing"></script>
<script type="text/javascript">
var mapZoom = 9;
var cyprus = new google.maps.LatLng(34.691739, 33.028203);
var city = <?= $form->getValue('city') ? 'new google.maps.LatLng('.$form->getValue('city')->getLatitude().', '.$form->getValue('city')->getLongitude().')' : 'null' ?>;
var marker = null;
var polygon = null;

jq(document).ready(function(){
	jq('#setLocation').click(function(){
		var center = cyprus;
		
		if (jq('#input_latitude').val() && jq('#input_longitude').val()) {
			center = new google.maps.LatLng(jq('#input_latitude').val(), jq('#input_longitude').val());
			mapZoom = 15;
			marker = new google.maps.Marker({position: center, draggable: true, animation: google.maps.Animation.DROP, zIndex: 1000});
		} else if (city) {
			center = city;
			mapZoom = 12;
		}

		var mapOptions = {
			center: center,
			zoom: mapZoom,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		jq('#locationModal')
			.modal('show')
			.on('shown', function(){

			var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

			if (marker) {
				marker.setMap(map);
			
				google.maps.event.addListener(marker, 'dragend', function(e) {
					map.panTo(e.latLng);
					jq('#input_latitude').val(e.latLng.lat());
					jq('#input_longitude').val(e.latLng.lng());
				});
			}

			var drawingManager = new google.maps.drawing.DrawingManager({
				drawingMode: null //google.maps.drawing.OverlayType.MARKER,
			,	drawingControl: true
			,	drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_CENTER,
					drawingModes: [
						google.maps.drawing.OverlayType.MARKER
//					,	google.maps.drawing.OverlayType.CIRCLE
					,	google.maps.drawing.OverlayType.POLYGON
//					,	google.maps.drawing.OverlayType.POLYLINE
//					,	google.maps.drawing.OverlayType.RECTANGLE
					]
				}
			,	polygonOptions: {
					editable: true
				,	fillColor: '#0C0'
				,	fillOpacity: 0.2
				,	strokeColor: '#090'
				,	strokeOpacity: 0.5
				,	strokeWeight: 2
				}
			,	markerOptions: {
					draggable:true
				,	animation: google.maps.Animation.DROP
				,	zIndex: 1000
				}
			,	circleOptions: {
					fillColor: '#ffff00'
				,	fillOpacity: 1
				,	strokeWeight: 5
				,	clickable: false
				,	editable: true
				,	zIndex: 1
				}
			});
			
			drawingManager.setMap(map);
			
			google.maps.event.addListener(drawingManager, 'markercomplete', function(newMarker){
				if (marker) {
					marker.setMap(null);
				}

				marker = newMarker;
				map.panTo(marker.getPosition());
				jq('#input_latitude').val(marker.getPosition().lat());
				jq('#input_longitude').val(marker.getPosition().lng());
				drawingManager.setDrawingMode(null);
				google.maps.event.addListener(marker, 'dragend', function(e) {
					map.panTo(e.latLng);
					jq('#input_latitude').val(e.latLng.lat());
					jq('#input_longitude').val(e.latLng.lng());
				});
			});

			google.maps.event.addListener(drawingManager, 'polygoncomplete', function(newPolygon) {
				if (polygon) {
					polygon.setMap(null);
				}

				polygon = newPolygon;
				drawingManager.setDrawingMode(null);
//				jq('#input_polygon').val(polygon.getPosition().lng());
			});
		});
	});
});

function clearMap()
{
	if (marker)
		marker.setMap(null);
	if (polygon)
		polygon.setMap(null);

	jq('#input_latitude').val('');
	jq('#input_longitude').val('');
	jq('#input_polygon').val('');
}
</script>


<div class="modal hide fade" id="locationModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modal header</h3>
	</div>
	<div class="modal-body">
		<div id="googleMap" style="width: 100%; height: 400px;"></div>
	</div>
	<div class="modal-footer">
		<a href="#" onclick="clearMap()" class="btn btn-danger">Clear map</a>
		<a href="#" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>