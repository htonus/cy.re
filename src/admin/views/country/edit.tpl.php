<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Country [ '.$form->getValue('id')->getName().' ]' : 'Add new Country'?></h1>

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
	<label class="control-label" for="input_country_code">ISO Code</label>
	<div class="controls">
		<input type="text" name="countryCode" class="" value="<?= $form->getValue('countryCode') ?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_phone_code">Phone Code</label>
	<div class="controls">
		<input type="text" name="phoneCode" class="" value="<?= $form->getValue('phoneCode') ?>" />
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=country'">Cancel</button>
    </div>
</div>