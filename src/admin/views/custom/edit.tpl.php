<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Block [ '.$form->getValue('type')->getName().' | '.i18nHelper::detokenize($form->getValue('section')->getName()).' ]': 'Add new Custom block'?></h1>

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
			<option value="<?= $item->getId()?>"<?= $default == $item->getId() ? ' selected="selected"' : null?>><?= i18nHelper::detokenize($item->getName()); ?></option>
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
			<a class="brand" href="#">Object search</a>

			<div class="navbar-search pull-left input-append">
				<input type="text" id="id_or_code" name="id_or_code" class="span2" placeholder="Search">
				<input type="button" id="searchButton" name="type" value="Article" class="btn">
				<input type="button" id="searchButton" name="type" value="Realty" class="btn">
			</div>
			
			<div class="pull-right">
				<button class="btn btn-primary" type="submit">Submit</button>
				<button class="btn" type="button" onclick="document.location.href='/index.php?area=district'">Cancel</button>
			</div>
		</div>
	</div>
</div>


<table class="table" id="itemList">
<tbody>
<?php
	$total = 0;
	
	if (
		$form->getValue('id')
		&& ($list = $form->getValue('id')->getItems()->getList())
	) {
		foreach ($list as $item) {
			$object = $item->getObject();
?>
		<tr>
			<td width="30px">
				<div class="btn-group btn-group-vertical">
					<a name="#" class="btn moveup"><i class="icon-arrow-up"></i></a>
					<a name="#" class="btn movedown"><i class="icon-arrow-down"></i></a>
				</div>
			</td>
			<td style="width: <?= PictureSize::thumbnail()->getWidth()?>px"><img src="<?= PictureSize::thumbnail()->getUrl($object->getPreview())?>"></td>
			<td>
				<?= strtoupper(get_class($object)) ?> |
				ID : <?= $object->getId() ?>
				<?= get_class($object) == 'Realty' ? ' | Code '.$object->getCode() : null ?>
				<br />
				<?= $object->getName()?>
			</td>
			<td class="pull-right">
				<input type="hidden" name="item[][<?= $object->getId() ?>]" value="<?= strtolower(get_class($object))?>"/>
				<a href="/index.php?area=<?= TextUtils::downFirst(get_class($object)) ?>&action=edit&id=<?= $object->getId()?>" target="_blank" class="btn btn-info">View</a>
				<button type="button" class="btn btn-warning" onclick="jq(this).parents('TR').remove()">Remove</button>
			</td>
		</tr>
<?php
		}
	} else {
?>
		<tr id="emptyList">
			<td colspan="3">Empty list</td>
		</tr>
<?php
	}
?>

</tbody></table>


</form>

<script type="text/javascript">

jq(document).ready(function(){
	
	jq('.moveup').click(itemMoveUp);
	
	jq('.movedown').click(itemMoveDown);
	
	jq('.navbar-search .btn').click(function(){
		var criteria = jq('#id_or_code').val();

		if (criteria.length < 1)
			return;

		jq.getJSON(
			'/index.php?area=custom&action=searchObject&object=' + jq(this).val() + '&criteria=' + criteria,
			function(data){
				if (data.error == '') {
					jq('#emptyList').remove();
					
					var tr = jq('#itemList TBODY').append('\
			<tr>\
				<td width="30px">\
					<div class="btn-group btn-group-vertical">\
						<a name="#" class="btn moveup"><i class="icon-arrow-up"></i></a>\
						<a name="#" class="btn movedown"><i class="icon-arrow-down"></i></a>\
					</div>\
				</td>\
				<td style="width: <?= PictureSize::thumbnail()->getWidth()?>px"><img src="' + data.item.url+ '"></td>\
				<td>' + data.item.type.toUpperCase() + ' | ID : ' + data.item.id + ' ' + (data.item.code ? ' | Code : ' + data.item.code : ' ') + '<br>' + data.item.name + '</td>\
				<td class="pull-right">\
					<input type="hidden" name="item[][' + data.item.object_id + ']" value="' + data.item.type + '"/>\
					<a href="/index.php?area=' + data.item.type + '&action=edit&id=' + data.item.object_id + '" target="_blank" class="btn btn-info">View</a>\
					<a href="/index.php?area=' + data.item.type + '&action=edit&id=' + data.item.object_id + '" target="_blank" class="btn btn-warning">Remove</a>\
				</td>\
			</tr>\
					');
					
					tr.find('.moveup').click(itemMoveUp);
					tr.find('.movedown').click(itemMoveDown);
					jq('#id_or_code').val('');
				} else {
					alert(data.error);
				}
			}
		);
	});
});

function itemMoveUp()
{
	var tr = jq(this).parents('TR');
	var prevTR = tr.prev();
	
	if (prevTR.size()) {
		tr.remove().insertBefore(prevTR);
		tr.find('.moveup').click(itemMoveUp);
		tr.find('.movedown').click(itemMoveDown);
	}
	
}
function itemMoveDown()
{
	var tr = jq(this).parents('TR');
	var nextTR = tr.next();
	
	if (nextTR.size()) {
		tr.remove().insertAfter(nextTR);
		tr.find('.moveup').click(itemMoveUp);
		tr.find('.movedown').click(itemMoveDown);
	}
}
</script>
