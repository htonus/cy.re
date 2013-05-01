<?php
/**
 * $Id$
 */
	
	$formFeatures = $form->getValue('feature')
		? $form->getValue('feature')
		: null;

	$group = FeatureTypeGroup::general();
?>
	<h4><?=$group->getName()?></h4>

	<div class="row-fluid">
<?php
	$features = FeatureType::dao()->getByGroup($group);

	$odd = false;
	foreach ($features as $featureId => $item) {
		$featureName = i18nHelper::changeCase($item->getName(), i18nHelper::SC);
		$featureValue = isset($formFeatures[$featureId])
			? $formFeatures[$featureId]
			: (empty($featureList[$featureId]) ? null : $featureList[$featureId]);
?>

		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="input_native"><?=$featureName?></label>
				<div class="controls">
					<input type="text" id="input_name" placeholder="<?=$featureName?>" name="feature[<?=$featureId?>]" value="<?=$featureValue?>" />
				</div>
			</div>
		</div>
<?php
		if ($odd) {
			echo '</div><div class="row-fluid">';
		}
		$odd = !$odd;
	}
?>
	</div>
	
	<div class="row-fluid">
		<div class="span6">
<?php
	$group = FeatureTypeGroup::indoor();
?>
			<h4><?=$group->getName()?></h4>
<?php
	$features = FeatureType::dao()->getByGroup($group);
	
	foreach ($features as $featureId => $item) {
		$checked = isset($formFeatures[$featureId])
			|| (
				!empty($featureList[$featureId])
				&& $featureList[$featureId] == 1
			)
			? 'checked="checked"'
			: null;
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
		$checked = isset($formFeatures[$featureId])
			|| (
				!empty($featureList[$featureId])
				&& $featureList[$featureId] == 1
			)
			? 'checked="checked"'
			: null;
?>
			<label class="checkbox">
				<input type="checkbox" name="feature[<?=$featureId?>]" value="1" <?=$checked?>> <?=$item->getName()?>
			</label>
<?php
	}
?>
		</div>
	</div>
