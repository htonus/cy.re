<?php
/**
 * $Id$
 */

	$features = array(
		FeatureType::PRICE,
		FeatureType::AREA,
		FeatureType::BEDROOMS,
		FeatureType::TOYLETS,
		FeatureType::PARKING_LOTS,
	);
	
	foreach ($features as $featureId) {
		$featureName = ucfirst($featureTypeList[$featureId]->getName());
?>

		<div class="control-group">
			<label class="control-label" for="input_native"><?=$featureName?></label>
			<div class="controls">
				<input type="text" id="input_name" placeholder="<?=$featureName?>" name="feature[<?=$featureId?>]" value="<?=empty($featureList[$featureId]) ? null : $featureList[$featureId]->getValue()?>" />
			</div>
		</div>

<?php
	}
?>

