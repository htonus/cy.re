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
	$partViewer->view('_parts/form/flash');

	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form name="editForm" id="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />


<?php
	$partViewer->view('_parts/form/i18n');
?>

<div class="control-group">
	<label class="control-label" for="input_prefix">Prefix for code (1 symbol)</label>
	<div class="controls">
		<input type="text" id="input_prefix" placeholder="Prefix 1 symbol" name="prefix" value="<?=$form->getValue('prefix')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_prefix">Area ranges</label>
	<div class="controls">
		<input type="hidden" id="input_areaRange" name="areaRange" value='<?= $form->getValue('areaRange') ?>' />
		<div id="areaListDiv"></div>
		<input type="text" name="newFrom" id="input_newFrom" class="input-small" style="background-color: #EFE;">
		-
		<input type="text" name="newTo" id="input_newTo" class="input-small" style="background-color: #EFE;">
		<input type="button" class="btn" value=" + " id="input_addRange">
    </div>
</div>


<div style="border-top: 1px #ddd solid; margin-bottom: 20px;"></div>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?=$area?>'">Cancel</button>
    </div>
</div>


</form>

<script type="text/javascript">
jq(document).ready(function(){
	var range = jq('#input_areaRange').val();

	if (range.length > 0) {
		var list = JSON.parse(range);
		for (var i = 0; i < list.length; i ++) {
			jq('#areaListDiv').append(tmpl("tmplRangeList", list[i]));
		}
	}

	jq('#editForm').submit(function(){
		var list = [];

		jq('#areaListDiv > DIV').each(function(){
			var from = parseInt(jq('.area-from', this).val());
			var to = parseInt(jq('.area-to', this).val());
			list.push({f: from , t: to});
		});

		jq('#input_areaRange').val(JSON.stringify(list));
	});

	jq('#input_addRange').click(function(){
		jq('#areaListDiv').append(
			tmpl(
				"tmplRangeList",
				{f: jq('#input_newFrom').val(), t: jq('#input_newTo').val()}
			)
		);
		jq('#input_newFrom, #input_newTo').val('');
	});
});

</script>

<script type="text/x-tmpl" id="tmplRangeList">
			<div style="margin-bottom: 5px">
				<input type="text" name="from[]" value="{%= '' + o.f %}" class="input-small area-from">
				-
				<input type="text" name="to[]" value="{%= '' + o.t %}" class="input-small area-to">
				<input type="button" class="btn" value=" x " onclick="jq(this).parent().remove()">
			</div>
</script>