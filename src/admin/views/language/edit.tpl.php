<?php
/*
 * $Id$
 */

	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Language: '.$form->getValue('id')->getName() : 'Add new Language'?></h1>

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


<div class="control-group">
	<label class="control-label" for="input_name">Name</label>
	<div class="controls">
		<input type="text" id="input_name" placeholder="Language name" name="name" value="<?=$form->getValue('name')?>" />
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_native">Native name</label>
	<div class="controls">
		<input type="text" id="input_name" placeholder="Language native" name="native" value="<?=$form->getValue('native')?>" />
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_name">Code</label>
	<div class="controls">
		<input type="text" id="input_code" placeholder="Language code" name="code" value="<?=$form->getValue('code')?>" />
    </div>
</div>

<div class="control-group">
	<div class="controls">
		<label class="checkbox" for="input_active">
			<input type="checkbox" id="input_active" placeholder="Is active" name="active" value="1" <?=$form->getValue('active') ? 'checked="checked"' : ''?> /> Is Active
		</label>
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=language'">Cancel</button>
    </div>
</div>




</form>
