<?php
/**
 * $Id$
 */
?>

<div class="row-fluid">

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_offerType">Offer Type</label>
			<div class="controls">
<?php
	$default = $form->getValue('offerType')
		? $form->getValue('offerType')->getId()
		: null;

	foreach ($offerTypeList as $item) {
?>
				<label class="radio inline">
					<input type="radio" name="offerType" id="offerType<?=$item->getId()?>" value="<?=$item->getId()?>" <?=$default == $item->getId() ? 'checked="checked"' : null?>>
					<?=$item->getName()?>
				</label>
<?php
	}
?>
			</div>
		</div>

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
			<label class="control-label" for="input_longitude">Longitude</label>
			<div class="controls">
				<input type="text" id="input_longitude" placeholder="longitude" name="longitude" value="<?= $form->getValue('longitude')?>" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input_latitude">Latitude</label>
			<div class="controls">
				<input type="text" id="input_latitude" placeholder="latitude" name="latitude" value="<?= $form->getValue('latitude')?>" />
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

