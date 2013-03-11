<?php
/**
 * $Id$
 */

	$features = FeatureType::dao()->getByGroup(FeatureTypeGroup::general());
	
	foreach ($features as $featureId => $item) {
		$featureName = i18nHelper::changeCase($item->getName(), i18nHelper::SC);
		$featureValue = empty($featureList[$featureId]) ? null : $featureList[$featureId];
?>

		<div class="control-group">
			<label class="control-label" for="input_native"><?=$featureName?></label>
			<div class="controls">
				<input type="text" id="input_name" placeholder="<?=$featureName?>" name="feature[<?=$featureId?>]" value="<?=$featureValue?>" />
			</div>
		</div>

<?php
	}
?>
	<div class="row-fluid">
		<div class="span6">
<?php
	$group = FeatureTypeGroup::indoor();
?>
			<h4><?=$group->getName()?></h4>
<?php
	$features = FeatureType::dao()->getByGroup($group);
	foreach ($features as $featureId => $item) {
		$checked = empty($featureList[$featureId])
			|| $featureList[$featureId] == 1
			? null
			: ' checked="checked"';
?>
			<label class="checkbox">
				<input type="checkbox" name="feature[<?=$featureId?>]" value="1" <?=$checked?>> <?=$item->getName()?>
			</label>
<?php
	}
?>
		</div>
		<div class="span6">
<?php
	$group = FeatureTypeGroup::outdoor();
?>
			<h4><?=$group->getName()?></h4>
<?php
	$features = FeatureType::dao()->getByGroup($group);
	foreach ($features as $featureId => $item) {
		$checked = empty($featureList[$featureId])
			|| $featureList[$featureId] == 1
			? null
			: ' checked="checked"';
?>
			<label class="checkbox">
				<input type="checkbox" name="feature[<?=$featureId?>]" value="1" <?=$checked?>> <?=$item->getName()?>
			</label>
<?php
	}
?>
		</div>
	</div>
