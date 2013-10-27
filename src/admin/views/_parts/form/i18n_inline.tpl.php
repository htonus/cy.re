<?php
/**
 * Expect:
 * $languageList
 * $i18n
 * $i18nList
 */

	if (empty($editorFor))
		$editorFor = null;

	$proto = call_user_func(array(get_class($subject).'_i18n', 'proto'));
	
?>

<div id="i18nBlock">

	
<!--Tabs -->
<ul class="nav nav-tabs">
<?php
	foreach ($languageList as $lang) {
?>
	<li class="<?= $lang->getCode() == 'en' ? 'active' : ''?>"><a href="#inline_lang_<?=$lang->getCode()?>" data-toggle="tab" id="lang_tab_<?=$lang->getCode()?>"><?=$lang->getName()?></a></li>
<?php
	}
?>
</ul>


<!--Form Language parts-->
<div class="tab-content" style="padding:10px;">
<?php
	foreach ($languageList as $lang) {
?>
	<div class="tab-pane<?= $lang->getCode() == 'en' ? ' active' : ''?>" id="inline_lang_<?=$lang->getCode()?>">
		
		<input type="hidden" name="i18n_id[<?=$lang->getCode()?>]" value="<?= empty($i18nList[$lang->getCode()]['id']) ? '' : $i18nList[$lang->getCode()]['id'] ?>" />
		
<?php
		foreach ($i18n as $name => $field) {
			if ($name == 'id')
				continue;

			$value = empty($i18nList[$lang->getCode()][$name])
				? ''
				: $i18nList[$lang->getCode()][$name];

			$id = 'input_'.$name.'_'.$lang->getCode();

			$max = $proto->getPropertyByName($name)->getMax()
?>

		<label for="<?=$id?>"><?=ucfirst($name)?></label>

<?php
			if (true || $name == $editorFor || $name == 'brief') {
?>
				<textarea maxlength="<?= $max; ?>" id="<?=$id?>" placeholder="Enter <?=$name?> ..." rows="5" class="input-block-level" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" style="height: 50px"><?=$value?></textarea>
<?php
			} else {
?>
				<input maxlength="<?= $max; ?>" type="text" id="<?=$id?>" class="input-block-level" placeholder="Enter <?=$name?> (<?=$lang->getCode()?>)" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" value="<?=$value?>" />
<?php
			}
		}
?>
		
	</div>
<?php
	}
?>
</div>


</div>