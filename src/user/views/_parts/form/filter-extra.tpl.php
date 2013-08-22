<?php
/**
 *
 */

	$group = FeatureTypeGroup::indoor();
	$features = FeatureType::dao()->getByGroup($group);
?>
	<div class="mt20" id="indoor_features">
		<h5><a href="javascript:void(null)" class="collapsed"><?=$group->getName()?></a></h5>
<?php
	$features = FeatureType::dao()->getByGroup($group);

	foreach ($features as $featureId => $item) {
		$checked = isset($filter[$featureId])
			|| (
				!empty($filter[$featureId])
				&& $filter[$featureId] == 1
			)
			? 'checked="checked"'
			: null;
?>
		<label class="checkbox <?= $checked ? null : 'hide'?>" for="input_f[<?=$featureId?>]">
			<input type="checkbox" id="input_f[<?=$featureId?>]" name="f[<?=$featureId?>]" value="1" <?=$checked?>> <?= ucfirst($item->getName()) ?>
		</label>
<?php
	}
?>
	</div>

<?php
	$group = FeatureTypeGroup::outdoor();
	$features = FeatureType::dao()->getByGroup($group);
?>
	<div class="mt20" id="outdoor_features">
		<h5><a href="javascript:void(null)" class="collapsed"><?=$group->getName()?></a></h5>
<?php
	$features = FeatureType::dao()->getByGroup($group);

	foreach ($features as $featureId => $item) {
		$checked = isset($filter[$featureId])
			|| (
				!empty($filter[$featureId])
				&& $filter[$featureId] == 1
			)
			? 'checked="checked"'
			: null;
?>
		<label class="checkbox <?= $checked ? null : 'hide'?>" for="input_f[<?=$featureId?>]">
			<input type="checkbox" id="input_f[<?=$featureId?>]" name="f[<?=$featureId?>]" value="1" <?=$checked?>> <?= ucfirst($item->getName()) ?>
		</label>
<?php
	}
?>
	</div>

	<div class="row-fluid mt20">
		<input type="submit" class="btn btn-small btn-black span12" value="___TTL-SUBMIT___">
	</div>

<script type="text/javascript">
jq(document).ready(function(){
	jq('#indoor_features A').click(function(){
		toggleFeaturesList(jq(this));
	});
	jq('#outdoor_features A').click(function(){
		toggleFeaturesList(jq(this));
	});
	jq('INPUT:checkbox').click(function(){
		if (jq(this).parent().parent().find('.collapsed').size())
			jq(this).parent().fadeOut();
	});
});

function toggleFeaturesList(toggle)
{
	var container = toggle.parent().parent();

	if (toggle.hasClass('collapsed')) {
		container.find('LABEL').fadeIn();
		toggle.removeClass('collapsed');
	} else {
		container.find('LABEL').hide();
		container.find(':checked').each(function(){
			jq(this).parent().fadeIn();
		});
		toggle.addClass('collapsed');
	}
}
</script>
