<?php
/**
 * Expect:
 * $languageList
 * $i18n
 * $i18nList
 */
?>

<div id="i18nBlock">

	
<!--Tabs -->
<ul class="nav nav-tabs">
<?php
	foreach ($languageList as $lang) {
?>
	<li class="<?= $lang->getCode() == 'en' ? 'active' : ''?>"><a href="#lang_<?=$lang->getCode()?>" data-toggle="tab"><?=$lang->getName()?></a></li>
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
		
		<input type="hidden" name="i18n_id[<?=$lang->getCode()?>]" value="<?= empty($i18nList[$lang->getCode()]) ? '' : $i18nList[$lang->getCode()]['id'] ?>" />
		
<?php
		foreach ($i18n as $name => $field) {
			if ($name == 'id')
				continue;
			
			$value = empty($i18nList[$lang->getCode()][$name])
				? ''
				: $i18nList[$lang->getCode()][$name];
?>
<div class="control-group">
	<label class="control-label" for="input_<?=$name?>_<?=$lang->getCode()?>"><?=ucfirst($name)?></label>
	<div class="controls">
		<input type="text" id="input_<?=$name?>_<?=$lang->getCode()?>" placeholder="Enter <?=$name?> (<?=$lang->getCode()?>)" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" value="<?=$value?>" />
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