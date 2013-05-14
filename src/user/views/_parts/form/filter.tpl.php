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
										<option>Choose ...</option>
<?php
	foreach ($realtyTypeList as $item) {
?>
										<option value="<?= $item->getId()?>"><?= ucwords($item->getName())?></option>
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
										<option>Choose ...</option>
<?php
	foreach ($cityList as $item) {
?>
										<option value="<?= $item->getId()?>"><?= ucwords($item->getName())?></option>
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
								<label class="control-label" for="input_realtyType">Price (&euro;)</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="t[<?= FeatureType::PRICE?>]">
										<option>Any</option>
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
	foreach ($priceList as $value => $title) {
?>
										<option value="<?= $value?>"><?= $title?></option>
<?php
	}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_area">Area (m<sup>2</sup>)</label>
								<div class="controls">
									<select type="text" class="input-block-level" class="f[<?= FeatureType::AREA?>]">
										<option value="">Any</option>
<?php
	$areaList = array(
		'-100'			=> 'up to 50',
		'50-100'		=> '50 - 100',
		'100-150'		=> '100 - 150',
		'150-200'		=> '150 - 200',
		'200-250'		=> '200 - 250',
		'250-'			=> 'from 250',
	);
	foreach ($areaList as $value => $title) {
?>
										<option value="<?= $value?>"><?= $title?></option>
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
								<label class="control-label" for="input_bedrooms" title="Bedrooms" style="overflow: hidden; white-space: nowrap;">Bedrooms</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::BEDROOMS?>]">
										<option>Any</option>
<?php
	for ($i = 1; $i < 5; $i ++) {
?>
										<option value="<?= $i?>"><?= $i?></option>
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
								<label class="control-label" for="input_city">Toilets</label>
								<div class="controls">
									<select type="text" class="input-block-level" name="f[<?= FeatureType::TOILETS?>]">
										<option>Any</option>
<?php
	for ($i = 1; $i < 5; $i ++) {
?>
										<option value="<?= $i?>"><?= $i?></option>
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
