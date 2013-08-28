<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Category: '.$form->getValue('id')->getName() : 'Add new Category'?></h1>

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
<input type="hidden" name="parent" value="<?=empty($parent) ? null : $parent->getId()?>" />


<?php
	$partViewer->view('_parts/form/i18n');
?>


<div style="border-top: 1px #ddd solid; margin-bottom: 20px;"></div>


<div class="control-group">
	<label class="control-label" for="input_slug">Slug (optional)</label>
	<div class="controls">
		<input type="text" id="input_slug" placeholder="Slug" name="slug" value="<?=$form->getValue('slug')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_parent">Parent</label>
	<div class="controls">
		<select name="parent" onchange="this.form.submit()" id="input_parent">
			<option value=""></option>
<?php
	$default = empty($parent)
		? null
		: $parent->getId();
	
	foreach ($categoryList as $item) {
		if ($item->getId() == $id)
			continue;
?>
		<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?= $area ?>'">Cancel</button>
    </div>
</div>


</form>
