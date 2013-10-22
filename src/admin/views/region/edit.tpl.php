<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update District: '.$form->getValue('id')->getName() : 'Add new District'?></h1>

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
<input type="hidden" name="country" value="<?=$country->getId()?>" />


<?php
	$partViewer->view('_parts/form/i18n');
?>


<div style="border-top: 1px #ddd solid; margin-bottom: 20px;"></div>

<div class="control-group">
	<label class="control-label" for="input_city_name">Country</label>
	<div class="controls">
		<input type="text" id="input_country" placeholder="Country" name="countryName" value="<?=$form->getValue('country')->getName()?>" readonly />
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_longitude">Longitude</label>
	<div class="controls">
		<input type="text" id="input_longitude" placeholder="Longitude" name="longitude" value="<?=$form->getValue('longitude')?>" />
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_longitude">Latitude</label>
	<div class="controls">
		<input type="text" id="input_Latitude" placeholder="Latitude" name="Latitude" value="<?=$form->getValue('latitude')?>" />
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?= $area; ?>'">Cancel</button>
    </div>
</div>


</form>
