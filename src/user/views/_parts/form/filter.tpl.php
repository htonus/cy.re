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
								<label class="control-label" for="input_f[<?= FeatureType::AREA?>]">Area (m<sup>2</sup>)</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::AREA?>]" id="input_f[<?= FeatureType::AREA?>]">
										<option value="">-</option>
<?php
	$areaList = array(
		'-100'			=> 'up to 50',
		'50-100'		=> '50 - 100',
		'100-150'		=> '100 - 150',
		'150-200'		=> '150 - 200',
		'200-250'		=> '200 - 250',
		'250-'			=> 'from 250',
	);
	
	$default = empty($filter[FeatureType::AREA])
		? null
		: $filter[FeatureType::AREA];
	
	foreach ($areaList as $value => $title) {
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
