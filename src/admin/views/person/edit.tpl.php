<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update User: '.$form->getValue('id')->getName() : 'Add new User'?></h1>

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
		<input type="text" id="input_name" placeholder="Name" name="name" value="<?=$form->getValue('name')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_surname">Surname</label>
	<div class="controls">
		<input type="text" id="input_surname" placeholder="Surname" name="surname" value="<?=$form->getValue('surname')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_email">Email</label>
	<div class="controls">
		<input type="text" id="input_email" placeholder="eMail" name="email" value="<?=$form->getValue('email')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_username">Username (login)</label>
	<div class="controls">
		<input type="text" id="input_username" placeholder="Username" name="username" value="<?=$form->getValue('username')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_password">Password</label>
	<div class="controls">
		<input type="password" id="input_password" placeholder="Password" name="password" value="<?=$form->getValue('password')?>" />
    </div>
</div>


<div class="control-group">
	<label class="control-label" for="input_status">Status</label>
	<div class="controls">
		<select name="status" id="input_status">
			<option value="">- Choose status -</option>
<?php
	$default = $form->getValue('status')
		? $form->getValue('status')->getId()
		: null;
	
	foreach ($statusList as $item) {
		if (
			$item->getId() == PersonStatus::ROOT
			&& !$user->isSuper()
		)
			continue;
?>
			<option value="<?=$item->getId()?>" <?=$default == $item->getId() ? 'selected="selected"' : null ?>><?=$item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?=$area?>'">Cancel</button>
    </div>
</div>


</form>
