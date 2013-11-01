<?php
/**
 * $Id$
 */
	
	$formFeatures = $form->getValue('feature')
		? $form->getValue('feature')
		: null;
?>

<div class="tabbable" style="margin-bottom: 18px;">
	
	<ul class="nav nav-tabs">

<?php
	foreach (FeatureTypeGroup::general()->getObjectList() as $group) {
?>
		<li class="<?= empty($first) ? 'active' : null ?>"><a href="#tab_<?= $group->getId()?>" data-toggle="tab"><?= i18nHelper::detokenize($group->getName()); ?></a></li>
<?php
		$first = true;
	}
	
	unset($first);
?>
	</ul>
	
	<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
<?php
	foreach (FeatureTypeGroup::general()->getObjectList() as $group) {
?>
		
		<div class="tab-pane <?= empty($first) ? 'active' : null ?>" id="tab_<?= $group->getId()?>">
			<h4><?= i18nHelper::detokenize($group->getName()); ?></h4>
			<div class="row">
<?php
		$features = FeatureType::dao()->getByGroup($group);
		
		$odd = false;
		foreach ($features as $featureId => $item) {
?>
			<div class="span4"><p>
<?php
			$featureName = i18nHelper::changeCase($item->getName(), i18nHelper::SC);
			
			if ($item->getUnit()->getType() == Unit::TYPE_BOOL) {
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
			} else {
				$featureValue = isset($formFeatures[$featureId])
					? $formFeatures[$featureId]
					: (empty($featureList[$featureId]) ? null : $featureList[$featureId]);
?>
				<label for="input_native"><?=$featureName?></label>
				<input type="text" id="input_name" placeholder="<?=$featureName?>" name="feature[<?=$featureId?>]" value="<?=$featureValue?>" />
<?php
			}
?>
			</p></div>
<?php
		}
		
//		if ($odd) {
//			echo '</div><div class="row-fluid">';
//		}
//		$odd = !$odd;
?>
			</div>
		</div>
		
<?php
		$first = true;
	}
?>
	</div>
	
</div>
