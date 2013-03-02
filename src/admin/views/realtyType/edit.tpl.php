<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Realty Type: '.$form->getValue('id')->getName() : 'Add new Realty Type'?></h1>

<?php
	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form name="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />


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
		
		<input type="hidden" name="i18n_id[<?=$lang->getCode()?>]" value="<?= empty($i18nList[$lang->getId()]) ? '' : $i18nList[$lang->getId()]->getId() ?>" />
		
<?php
		foreach ($i18n as $name => $field) {
			if (in_array($name, array('id', 'language', 'object')))
				continue;
?>
<div class="control-group">
	<label class="control-label" for="input_<?=$name?>_<?=$lang->getCode()?>"><?=ucfirst($name)?></label>
	<div class="controls">
		<input type="text" id="input_<?=$name?>_<?=$lang->getCode()?>" placeholder="Enter <?=$name?> (<?=$lang->getCode()?>)" name="i18n_field[<?=$lang->getCode()?>][<?=$name?>]" value="<?=empty($i18nList[$lang->getId()]) ? '' : $i18nList[$lang->getId()]->{'get'.ucfirst($name)}()?>" />
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


<div style="border-top: 1px #ddd solid; margin-bottom: 20px;"></div>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?=$area?>'">Cancel</button>
    </div>
</div>


</form>
