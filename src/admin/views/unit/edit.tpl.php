<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Unit: '.$form->getValue('id')->getName() : 'Add new Unit'?></h1>

<?php
	$partViewer->view('_parts/form/flash');

	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form name="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />


<?php
	$partViewer->view('_parts/form/i18n');
?>


<div style="border-top: 1px #ddd solid; margin-bottom: 20px;"></div>

<div class="control-group">
	<label class="control-label" for="input_native">Sign</label>
	<div class="controls">
		<input type="text" id="input_name" placeholder="Language native" name="sign" value="<?=$form->getValue('sign')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_native">Type</label>
	<div class="controls">
		<select name="type">
			<option value="">Choose ...</option>
<?php
	$default = $form->getValue('type')
		? $form->getValue('type')
		: null;
	
	foreach (Unit::create()->getTypeList() as $id => $name) {
?>
			<option value="<?= $id?>" <?= $default == $id ? ' selected="selected"' : null; ?>><?= $name; ?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=unit'">Cancel</button>
    </div>
</div>


</form>
