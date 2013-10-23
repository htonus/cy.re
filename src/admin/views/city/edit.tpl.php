<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update City: '.$form->getValue('id')->getName() : 'Add new City'?></h1>

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
	<label class="control-label" for="input_country">Country</label>
	<div class="controls">
		<select name="country" id="input_country">
			<option value="">Choose country</option>
<?php
	$default = $form->getValue('country')
		? $form->getValue('country')->getId()
		: null;

	foreach ($countryList as $item) {
?>
			<option value="<?=$item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null ?>><?=$item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_region">District</label>
	<div class="controls">
		<select name="region" id="input_region">
			<option value="">Choose District</option>
<?php
	$default = $form->getValue('region')
		? $form->getValue('region')->getId()
		: null;
	
	foreach ($regionList as $item) {
?>
			<option value="<?=$item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null ?>><?=$item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_prefix">Prefix (2 symbols)</label>
	<div class="controls">
		<input type="text" id="input_prefix" placeholder="Prefix for code - 2 symbols" name="prefix" value="<?=$form->getValue('prefix')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_latitude">Latitude</label>
	<div class="controls">
		<input type="text" id="input_latitude" placeholder="Latitude xx.xxxxxx" name="latitude" value="<?=$form->getValue('latitude')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_longitude">Longitude</label>
	<div class="controls">
		<input type="text" id="input_longitude" placeholder="Longitude xx.xxxxxx" name="longitude" value="<?=$form->getValue('longitude')?>" />
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?=$area?>'">Cancel</button>
    </div>
</div>


</form>

<script type="text/javascript">
jq(document).ready(function(){
	
	jq('#input_country').change(function(){
		jq('#input_region OPTION').remove();
		
		jq.getJSON(
			'<?= PATH_WEB_ADMIN?>?area=city&action=list',
			{
				country	: jq(this).val()
			,	region	: null
			,	city	: null
			},
			function(data){
				if (typeof data.regionList != 'undefined')
					updateSelector('region', data.regionList);
			}
		);
	});
});

function updateSelector(name, list)
{
	var selector = jq('#input_' + name);
	var selected = false;
	
	jq('OPTIONS', selector).remove();
	
	if (list.length > 1) {
		selector.append('<option value=""></option>');
	} else if (list.length == 1) {
		selected = ' selected="selected"';
	}
	
	for (var id in list)
		selector.append('<option value="' + id + '"' + selected + '>' + list[id] + '</option>');
}
</script>