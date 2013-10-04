<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Static page: '.$form->getValue('id')->getName() : 'Add new Static page'?></h1>

<?php
	$partViewer->view('_parts/form/flash');

	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form
	id="fileupload"
	action="/index.php"
	method="POST"
	class="form-horizontal"
>

<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />


<?php
	$model->set('editorFor', 'text');
	$partViewer->view('_parts/form/i18n');
?>
	
<div class="control-group">
	<label class="control-label" for="input_city_name">Type</label>
	<div class="controls">
		<select name="type" class="select">
<?php
	if (empty($type)) {
		$default = $form->getValue('type')
			? $form->getValue('type')->getId()
			: null;
	} else {
		$default = $type->getId();
	}

	foreach ($staticTypeList as $item) {
		if (
			!empty($type)
			&& $default != $item->getId()
		)
			continue;
?>
			<option value="<?= $item->getId()?>"<?= $default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_city_name">Section</label>
	<div class="controls">
		<select name="section" class="select">
			<option value="">All sections</option>
<?php
	if (empty($section)) {
		$default = $form->getValue('section')
			? $form->getValue('section')->getId()
			: null;
	} else {
		$default = $section->getId();
	}

	foreach ($sectionList as $item) {
		if (
			!empty($section)
			&& $default != $item->getId()
		)
			continue;
?>
			<option value="<?= $item->getId()?>"<?= $default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?=$area?>&type=<?= empty($type) ? null : $type->getId(); ?>&section=<?= empty($section)? null : $section->getId(); ?>'">Cancel</button>
    </div>
</div>

</form>
