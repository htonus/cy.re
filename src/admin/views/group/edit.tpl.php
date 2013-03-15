<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Group: '.$form->getValue('id')->getName() : 'Add new Group'?></h1>

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
	<label class="control-label" for="input_name">Group name</label>
	<div class="controls">
		<input type="text" id="input_name" placeholder="Object name" name="name" value="<?=$form->getValue('name')?>" />
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_text">Group description</label>
	<div class="controls">
		<textarea id="input_text" class="input-block-level" placeholder="Group description" name="text"><?=$form->getValue('text')?></textarea>
    </div>
</div>

<table class="table table-striped">
<thead>
	<tr>
		<th>Resource \ Access</th>
<?php
	foreach ($accessTypeList as $item) {
?>
		<th><?=$item->getName()?></th>
<?php
	}
?>
	</tr>
</thead>

<tbody>
<?php
	foreach ($resourceList as $resource) {
?>
	<tr>
		<td><?=$resource->getName()?></td>
<?php
	foreach ($accessTypeList as $access) {
		$checked = isset($rulePlainList[$resource->getId()][$access->getId()])
			? 'checked="checked"'
			: null;
?>
		<td><input type="checkbox" name="rule[<?=$resource->getId()?>][<?=$access->getId()?>]" value="1" <?=$checked?> /></td>
<?php
	}
?>
	</tr>
<?php
	}
?>
</tbody>
</table>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=resource'">Cancel</button>
    </div>
</div>


</form>
