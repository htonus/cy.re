<?php
/*
 * $Id$
 */
	
	$class = get_class($user);
?>

<h1>Setup Access for User</h1>

<br/>

<form name="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="person" />
<input type="hidden" name="action" value="access" />
<input type="hidden" name="id" value="<?=$user->getId()?>" />



<div class="control-group">
	<label class="control-label" for="input_group">User</label>
	<div class="controls">
		<?=$user->getName()?> <?=$user->getSurname()?>
		(<?=$user->getUsername()?>)
		<?=$user->getEmail()?>
	</div>
</div>


<div class="control-group">
	<label class="control-label" for="input_group">Groups</label>
	<div class="controls">
		<select name="group[]" id="input_group" multiselect>
			<option value="">- Choose group -</option>
<?php
	foreach ($groupList as $item) {
?>
			<option value="<?=$item->getId()?>"><?=$item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<table class="table table-striped">
<thead>
	<tr>
		<th>Resource \ Access</th>
<?php
	foreach ($accessPlainList as $id => $name) {
?>
		<th><?=$name?></th>
<?php
	}
?>
	</tr>
</thead>

<tbody>
<?php
	$rules = $form->getValue('id')
		? $form->getValue('id')->getRuleList()
		: array();
	
	foreach ($resourceList as $resource) {
?>
	<tr>
		<td><?=$resource->getName()?></td>
<?php
		foreach ($accessPlainList as $accessId => $accessName) {
			$checked = isset($rules[$resource->getId()])
				&& $rules[$resource->getId()]->getAccess() & $accessId
				? 'checked="checked"'
				: null;
?>
		<td><input type="checkbox" name="rule[<?=$resource->getId()?>][]" value="<?=$accessId?>" <?=$checked?> /></td>
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
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=group'">Cancel</button>
    </div>
</div>


</form>
