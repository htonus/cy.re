<?php
/**
 *
 */
?>
	<div class="mt20" id="indoor_features">
		<h5><a href="#" class="collapsed">Indoor Features:</a></h5>
<?php
	$indoorList = array(1,2,3,4,5);

	foreach ($indoorList as $item) {
		$checked = $item % 2 == 0;
?>
		<label class="checkbox <?= $checked ? null : 'hide'?>" for="indoor_feature_<?= $item?>">
			<input <?= $checked ? 'checked="checked"' : null?> type="checkbox" id="indoor_feature_<?= $item?>" name="filter[feature][<?= $item?>]" value="1"> Indoor feature <?= $item?>
		</label>
<?php
	}
?>
	</div>

	<div class="mt20" id="outdoor_features">
		<h5><a href="#" class="collapsed">Outdoor Features:</a></h5>
<?php
	$outdoorList = array(1,2,3,4,5);

	foreach ($outdoorList as $item) {
		$checked = $item % 2 == 0;
?>
		<label class="checkbox <?= $checked ? null : 'hide'?>" for="indoor_feature_<?= $item?>">
			<input <?= $checked ? 'checked="checked"' : null?> type="checkbox" id="indoor_feature_<?= $item?>" name="filter[feature][<?= $item?>]" value="1"> Outdoor feature <?= $item?>
		</label>
<?php
	}
?>
	</div>

	<div class="row-fluid">
		<input type="submit" class="btn btn-small btn-black span12" value="Submt">
	</div>

<script type="text/javascript">
jq(document).ready(function(){
	jq('#indoor_features A').click(function(){
		toggleFeaturesList(jq(this));
	});
	jq('#outdoor_features A').click(function(){
		toggleFeaturesList(jq(this));
	});
});

function toggleFeaturesList(toggle)
{
	var container = toggle.parent().parent();

	if (toggle.hasClass('collapsed')) {
		container.find('LABEL').slideDown();
		toggle.removeClass('collapsed');
	} else {
		container.find('LABEL').slideDown();
		container.find(':checked').each(function(){
			jq(this).parent().slideUp();
		});
		toggle.addClass('collapsed');
	}
}
</script>