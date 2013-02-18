<?php
/*
 * $Id$
 */

	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h2><?=$id ? "Update $class $id" : "Add new $class"?></h2>

<?php
	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<table>
<form name="editForm" action="/index.php" method="post">
<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<?php

	foreach ($form->getPrimitiveList() as $name => $primitive) {
		 if ($name == 'id')
			 continue;
		 
		 if (($name == 'password') && $id)
			 continue;

		 if ($primitive instanceof PrimitiveBoolean) {
			 $checked = $form->getValue($name) == true;
?>
	<tr>
		<td align="right"><?=$primitive->isRequired() ? '*' : ''?> <b><?=$name?></b> </td>
		<td><input type="checkbox" name="<?=$name?>" value="<?= $form->getValue($name)?>" <?= $checked ? ' checked="checked"' : null?>></td>
	</tr>
<?php
		 } else {
?>
	<tr>
		<td align="right"><?=$primitive->isRequired() ? '*' : ''?> <b><?=$name?></b> </td>
		<td><input type="text" name="<?=$name?>" value="<?= $form->getValue($name)?>"></td>
	</tr>
<?php
		 }
		
	}
?>

	<tr>
		<td></td>
		<td><input type="submit"></td>
	</tr>
	
</form>
</table>
