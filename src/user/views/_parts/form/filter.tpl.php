<?php
/**
 *
 */
?>
					<h4 class="visible-desktop">Search filter:</h4>
					
					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_realtyType">Realty type</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="realtyType">
										<option value="">-</option>
<?php
	$default = empty($realtyType)
		? null
		: $realtyType->getId();
	
	foreach ($realtyTypeList as $item) {
		$selected = $item->getId() == $default
			? ' selected="selected"'
			: null;
?>
										<option value="<?= $item->getId()?>"<?= $selected?>><?= ucwords($item->getName())?></option>
<?php
	}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_city">Area, City</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="city">
										<option value="">-</option>
<?php
	$default = empty($city)
		? null
		: $city->getId();
	
	foreach ($cityList as $item) {
		$selected = $item->getId() == $default
			? ' selected="selected"'
			: null;
?>
										<option value="<?= $item->getId()?>"<?= $selected?>><?= ucwords($item->getName())?></option>
<?php
	}
?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_f[<?= FeatureType::PRICE?>]">Price (&euro;)</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::PRICE?>]">
										<option value="">-</option>
<?php
	$priceList = array(
		'-100000'			=> 'up to 100k',
		'100000-200000'		=> '100k - 200k',
		'200000-300000'		=> '200k - 300k',
		'300000-400000'		=> '300k - 400k',
		'400000-500000'		=> '400k - 500k',
		'500000-1000000'	=> '500k - 1M',
		'1000000-'			=> 'from 1M',
	);

	$priceList = array();

	$multiplier = $area == 'rent'
		? 1
		: 1000;
	
	$price = 100 * $multiplier;

	for ($i = 0; $i < 6; $i ++) {
		$price1 = $price * pow(2, $i - 1);
		$price2 = $price * pow(2, $i);
		
		$priceList[($i == 0 ? '' : $price1).'-'.($i == 5 ? '' : $price2)] =
			($i == 0 ? 'up to' : number_format($price1, 0, '.', "'"))
			.($i % 5 ? ' - ' : ' ')
			.($i == 5 ? 'and more' : number_format($price2, 0, '.', "'"));
	}
	
	$default = empty($filter[FeatureType::PRICE])
		? null
		: $filter[FeatureType::PRICE];
	
	foreach ($priceList as $value => $title) {
		$selected = $value == $default
			? ' selected="selected"'
			: null;
?>
										<option value="<?= $value?>"<?= $selected?>><?= $title?></option>
<?php
	}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_f[<?= FeatureType::AREA?>]">
									Area (<?= $featureTypeList[FeatureType::AREA]->getSign(); ?>)
								</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::AREA?>]" id="input_f[<?= FeatureType::AREA?>]">
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_f[<?= FeatureType::BEDROOMS?>]" title="Bedrooms" style="overflow: hidden; white-space: nowrap;">Bedrooms</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::BEDROOMS?>]" id=""input_f[<?= FeatureType::BEDROOMS?>]>
										<option value="">-</option>
<?php
	$default = empty($filter[FeatureType::BEDROOMS])
		? null
		: $filter[FeatureType::BEDROOMS];
	
	for ($i = 1; $i < 5; $i ++) {
		$selected = $value == $default
			? ' selected="selected"'
			: null;
?>
										<option value="<?= $i?>"<?= $selected?>><?= $i?></option>
<?php
	}
?>
										<option>5 +</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_f[<?= FeatureType::TOILETS?>]">Toilets</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::TOILETS?>]" id=""input_f[<?= FeatureType::TOILETS?>]>
										<option value="">-</option>
<?php
	$default = empty($filter[FeatureType::BEDROOMS])
		? null
		: $filter[FeatureType::BEDROOMS];
	
	for ($i = 1; $i < 5; $i ++) {
		$selected = $value == $default
			? ' selected="selected"'
			: null;
?>
										<option value="<?= $i?>"<?= $selected?>><?= $i?></option>
<?php
	}
?>
										<option>5 +</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_city">&nbsp;</label>
								<div class="controls">
									<button class="btn input-block-level">Search</button>
								</div>
							</div>
						</div>
					</div>
<script type="text/javascript">
var bigAreaRealty = [11, 17];

jq(document).ready(function(){
	jq('SELECT[name="realtyType"]').change(function(){
		manageControls(parseInt(jq(this).val()));
	});
	
	manageControls(jq('SELECT[name="realtyType"]').val());
});

function manageControls(realtyType)
{
	updateArea(realtyType);
	if (jq.inArray(realtyType, bigAreaRealty) != -1) {
		jq('SELECT[name="f[<?= FeatureType::BEDROOMS?>]"]').attr('disabled', 'disabled')
		jq('SELECT[name="f[<?= FeatureType::TOILETS?>]"]').attr('disabled', 'disabled')
	} else {
		jq('SELECT[name="f[<?= FeatureType::BEDROOMS?>]"]').removeAttr('disabled');
		jq('SELECT[name="f[<?= FeatureType::TOILETS?>]"]').removeAttr('disabled');
	}
}

function updateArea(realtyType)
{
	var step = 50 * (jq.inArray(realtyType, bigAreaRealty) == -1 ? 1: 100);

	var areaSelector = jq('SELECT[name="f[<?= FeatureType::AREA?>]"]');
	areaSelector.find('OPTION').remove();
	areaSelector.append('<option value="">-</option>');
	for (i = 1; i < 7; i ++) {
		var from = i == 1 ? '' : (i - 1) * step;
		var to = i == 6 ? '' : i * step;
		areaSelector.append(
			'<option value="' + from + '-' + to	+ '">'
			+ (from == '' ? '&lt; ' : from)
			+ (from == '' || to == '' ? ' ' : ' - ')
			+ (to == '' ? '&gt;' : to)
			+ '</option>'
		);
	}
}
</script>
	