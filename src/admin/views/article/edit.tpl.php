<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Article: '.$form->getValue('id')->getName() : 'Add new Article'?></h1>

<?php
	$partViewer->view('_parts/form/flash');

	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<!-- form name="editForm" action="/index.php" method="post" class="form-horizontal" -->
<form
	id="fileupload"
	action="/index.php"
	method="POST"
	enctype="multipart/form-data"
	class="form-horizontal"
>

<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />

<?php
	$partViewer->view('_parts/form/dates');
?>

<div class="navbar">
	<div class="navbar-inner">
		<b class="brand">Sections</b>
		<ul class="nav nav-tabs">
			<li<?= $id ? null : ' class="active"'?>><a href="#tab_description" data-toggle="tab">Description</a></li>
			<li<?= $id ? ' class="active"' : null?>><a href="#tab_pictures" data-toggle="tab">Pictures</a></li>
		</ul>
		<div class="controls pull-right">
			<button class="btn" type="button" onclick="document.location.href='/index.php?area=<?= $area?>'">Cancel</button>
			<button class="btn btn-primary" type="submit" id="btnSubmit">Submit</button>
<?php
	if ($id) {
		$publish = $form->getValue('published') ? 0 : 1;
?>
			<button class="btn btn-danger" type="button" onclick="document.location.href='/index.php?area=<?= $area?>&action=publish&id=<?= $id?>&active=<?= $publish?>'"><?= empty($publish) ? 'Un-publish' : 'Publish'?></button>
<?php
	}
?>
		</div>
	</div>
</div>


<div class="tab-content">

	<div class="tab-pane<?= $id ? null : ' active'?>" id="tab_description">
<?php
	$model->set('editorFor', 'text');
	$partViewer->view('_parts/form/i18n');
?>
		<div class="control-group">
			<label class="control-label" for="input_category">Category</label>
			<div class="controls">
				<select name="category" id="input_category">
					<option value=""></option>
<?php
	$default = $form->getValue('category')
		? $form->getValue('category')->getId()
		: null;

	$level = 0;
	$parentId = 0;
	foreach ($categoryList as $item) {
		if ($item->getParentId() != $parentId) {
			if ($item->getParentId() < 1)
				$level = 0;
			else
				$level ++;

			$parentId = $item->getParentId();
		}
?>
					<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>>
						<?= str_repeat(' &nbsp; &nbsp;  ', $level) ?>
						<?= $item->getName()?>
					</option>
<?php
	}
?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="tab-pane<?= $id ? ' active' : null?>" id="tab_pictures">
<?php
	$partViewer->view('article/parts/pictures');
?>
	</div>

</form>

</div>
