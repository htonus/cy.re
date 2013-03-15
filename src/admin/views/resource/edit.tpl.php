<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Resource: '.$form->getValue('id')->getName() : 'Add new Resource'?></h1>

<?php
	if ($form->getErrors()) {
		$partViewer->view('_parts/form/errors', Model::create()->set('form', $form));
	}
?>

<br/>

<form name="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />


<div class="control-group">
	<label class="control-label" for="input_name">Object name</label>
	<div class="controls">
		<input type="text" id="input_name" placeholder="Object name" name="name" value="<?=$form->getValue('name')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_type">Resource Type</label>
	<div class="controls">
		<select name="type">
<?php
	$value = $form->getValue('id') ? $form->getValue('type')->getId() : null;
	
	foreach ($resourceTypeList as $item) {
?>
	<option value="<?= $item->getId()?>"<?= $item->getId() == $value ? ' selected="selected"' : ''?>><?=$item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=resource'">Cancel</button>
    </div>
</div>


</form>
