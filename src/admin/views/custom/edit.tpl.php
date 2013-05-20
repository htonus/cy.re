<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update District: '.$form->getValue('id')->getName() : 'Add new Custom block'?></h1>

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
	<label class="control-label" for="input_city_name">Type</label>
	<div class="controls">
		<select name="type" class="select">
<?php
	if (empty($customType)) {
		$default = $form->getValue('type')
			? $form->getValue('type')->getId()
			: null;
	} else {
		$default = $customType->getId();
	}

	foreach ($customTypeList as $item) {
		if (
			!empty($customType)
			&& $default != $item->getId()
		)
			continue;
?>
			<option value="<?= $item->getId()?>"<?= $default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_city_name">Section</label>
	<div class="controls">
		<select name="section" class="select">
<?php
	if (empty($section)) {
		$default = $form->getValue('section')
			? $form->getValue('section')->getId()
			: null;
	} else {
		$default = $section->getId();
	}

	foreach ($sectionList as $item) {
		if (
			!empty($section)
			&& $default != $item->getId()
		)
			continue;
?>
			<option value="<?= $item->getId()?>"<?= $default == $item->getId() ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
		</select>
    </div>
</div>

<div class="control-group">
	<label class="control-label" for="input_name">Description</label>
	<div class="controls">
		<textarea id="input_name" placeholder="name" name="name">
			<?=$form->getValue('name')?>"
		</textarea>
    </div>
</div>

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

<table class="table" id="itemList">
<tbody>
<?php
	if (
		$form->getValue('id')
		&& ($list = $form->getValue('id')->getItems()->getList())
	) {
		foreach ($list as $item) {
			$realty = $item->getRealty();
?>
		<tr>
			<td><img src="<?= PictureSize::thumbnail()->getUrl($realty->getPreview())?>"></td>
			<td><?= $realty->getName()?></td>
			<td>
				<input type="hidden" name="item[<?= $realty->getId()?>]" value="<?=$item->getId()?>"/>
				<input type="hidden" name="order[<?= $realty->getId()?>]" value="<?=$item->getOrder()?>"/>
				<a href="/index.php?area=realty&action=edit&id=<?= $realty->getId()?>" target="_blank" class="btn btn-info">View</a>
				<a href="/index.php?area=realty&action=edit&id=<?= $realty->getId()?>" target="_blank" class="btn btn-warning">Remove</a>
			</td>
		</tr>
<?
		}
	} else {
?>
		<tr>
			<td colspan="3">Empty list</td>
		</tr>
<?php
	}
?>

</tbody></table>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=district'">Cancel</button>
    </div>
</div>


</form>

<script type="text/javascript">
jq(document).ready(function(){
	jq('#searchButton').click(function(){
		var criteria = jq('#id_or_code').val();

		if (criteria.length < 1)
			return;

		jq.getJSON(
			'/index.php?area=custom&action=searchRealty&criteria=' + criteria,
			function(data){
				if (data.error == '') {
					jq('#itemList TBODY').append('\
			<tr>\
				<td><img src="' + data.item.url+ '"></td>\
				<td>' + data.item.name + '</td>\
				<td>\
					<input type="hidden" name="item[' + data.item.realty_id + ']" value="' + data.item.id + '"/>\
					<input type="hidden" name="order[' + data.item.realty_id + ']" value="' + data.item.order + '"/>\
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