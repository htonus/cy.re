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
			<li><a href="#tab_sites" data-toggle="tab">Branded realty</a></li>
		</ul>
		<div class="pull-right">
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


	<div class="tab-pane" id="tab_sites">

		<table class="table" id="itemList">
		<tbody>
<?php
	$total = 0;

	if (
		$form->getValue('id')
		&& ($list = $form->getValue('id')->getSites()->getList())
	) {
		foreach ($list as $item) {
			$total ++;
			$realty = $item;
?>
			<tr>
				<td><img src="<?= PictureSize::thumbnail()->getUrl($realty->getPreview())?>"></td>
				<td>
					<b><?= $realty->getCode()?></b> : <?= $realty->getName()?>
				</td>
				<td style="text-align: right">
					<input type="hidden" name="sites[]" value="<?= $id?>"/>
					<a href="/index.php?area=realty&action=edit&id=<?= $realty->getId()?>" target="_blank" class="btn btn-info">View</a>
					<button type="button" class="btn btn-warning" onclick="jq(this).parents('TR').remove()">Remove</button>
				</td>
			</tr>
<?
		}
	} else {
?>
			<tr id="emptyList">
				<td colspan="3">Empty list</td>
			</tr>
<?php
	}
?>
		</tbody>
		</table>

		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="#">Realty search</a>

					<ul class="nav">
						<li><a href="#">Enter ID or CODE</a></li>
						<li class="navbar-search">
							<input type="text" id="id_or_code" name="id_or_code" class="search-query span2" placeholder="Search">
						</li>
						<li>&nbsp;</li>
						<li>
							<input type="button" id="searchButton" name="input_id_or_code" value="Attach" class="btn">
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
	
</form>

</div>

<script type="text/javascript">
var itemListTotal = <?= $total?>;

jq(document).ready(function(){

	jq('.moveup').click(itemMoveUp);

	jq('.movedown').click(itemMoveDown);

	jq('#searchButton').click(function(){
		var criteria = jq('#id_or_code').val();

		if (criteria.length < 1)
			return;

		jq.getJSON(
			'/index.php?area=custom&action=searchRealty&criteria=' + criteria,
			function(data){
				if (data.error == '') {
					itemListTotal ++;
					jq('#emptyList').remove();
					jq('#itemList TBODY').append('\
			<tr>\
				<td style="width: <?= PictureSize::thumbnail()->getWidth()?>px"><img src="' + data.item.url+ '"></td>\
				<td><b>' + data.item.realty_code + '</b> : ' + data.item.name + '</td>\
				<td style="text-align: right">\
					<input type="hidden" name="sites[]" value="' + data.item.realty_id + '"/>\
					<a href="/index.php?area=realty&action=edit&id=' + data.item.realty_id + '" target="_blank" class="btn btn-info">View</a>\
					<a href="/index.php?area=realty&action=edit&id=' + data.item.realty_id + '" target="_blank" class="btn btn-warning">Remove</a>\
				</td>\
			</tr>\
					');
				} else {
					alert(data.error);
				}
			}
		);
	});
});
</script>