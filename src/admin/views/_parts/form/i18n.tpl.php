<?php
/**
 * Expect:
 * $languageList
 * $i18n
 * $i18nList
 */

	if (empty($editorFor))
		$editorFor = null;
	
	if (!empty($editorFor)) {
		$partViewer->view('_parts/form/wysywig');
?>
<script type="text/javascript">
jq(document).ready(function(){
	jq('#i18nBlock a[data-toggle=tab]').click(function (e) {
		var lang = jq(e.target).attr('id').replace(/lang_tab_/, '');
		attachEditor('input_<?=$editorFor?>_' + lang);
	});
	
	attachEditor('input_<?=$editorFor?>_en');
});
</script>
<?php
	}
?>

<div id="i18nBlock">

	
<!--Tabs -->
<ul class="nav nav-tabs">
<?php
	foreach ($languageList as $lang) {
?>
	<li class="<?= $lang->getCode() == 'en' ? 'active' : ''?>"><a href="#lang_<?=$lang->getCode()?>" data-toggle="tab" id="lang_tab_<?=$lang->getCode()?>"><?=$lang->getName()?></a></li>
<?php
	}
?>
</ul>


<!--Form Language parts-->
<div class="tab-content">
<?php
	foreach ($languageList as $lang) {
?>
	<div class="tab-pane<?= $lang->getCode() == 'en' ? ' active' : ''?>" id="lang_<?=$lang->getCode()?>">
		
		<input type="hidden" name="i18n_id[<?=$lang->getCode()?>]" value="<?= empty($i18nList[$lang->getCode()]['id']) ? '' : $i18nList[$lang->getCode()]['id'] ?>" />
		
<?php
		foreach ($i18n as $name => $field) {
			if ($name == 'id')
				continue;

			$value = empty($i18nList[$lang->getCode()][$name])
				? ''
				: $i18nList[$lang->getCode()][$name];

			$id = 'input_'.$name.'_'.$lang->getCode();
?>

		<div class="control-group">
			<label class="control-label" for="<?=$id?>"><?=ucfirst($name)?></label>
			<div class="controls">

<?php
			if ($name == $editorFor) {
?>
				<textarea id="<?=$id?>" placeholder="Enter <?=$name?> ..." rows="15" class="span7" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" style="height: 300px"><?=$value?></textarea>
<?php
			} else {
?>
				<input type="text" id="<?=$id?>" class="span7" placeholder="Enter <?=$name?> (<?=$lang->getCode()?>)" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" value="<?=$value?>" />
<?php
			}
?>
			</div>
		</div>
<?php
		}
?>
		
	</div>
<?php
	}
?>
</div>


</div>