<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Block [ '.$form->getValue('type')->getName().' | '. $form->getValue('section')->getName().' ]': 'Add new Custom block'?></h1>

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
			$total ++;
			$realty = $item->getRealty();
?>
		<tr>
			<td width="30px">
				<div class="btn-group btn-group-vertical">
					<a name="#" class="btn moveup"><i class="icon-arrow-up"></i></a>
					<a name="#" class="btn movedown"><i class="icon-arrow-down"></i></a>
				</div>
			</td>
			<td><img src="<?= PictureSize::thumbnail()->getUrl($realty->getPreview())?>"></td>
			<td>
				<b><?= $realty->getCode()?></b> : <?= $realty->getName()?>
			</td>
			<td class="pull-right">
				<input type="hidden" name="item[<?= $realty->getId()?>]" value="<?= $total?>"/>
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

</tbody></table>


</form>

<script type="text/javascript">
var itemListTotal = <?= $total?>;

jq(document).ready(function(){
	
	jq('.moveup').click(function(){
		var tr = jq(this).parents('TR');
		var prevTR = tr.prev();
		
		if (prevTR.size()) {
			var order = tr.find(':hidden').val();
			tr.remove().insertBefore(prevTR);
			prevTR.find(':hidden').val(order);
			tr.find(':hidden').val(order- 1);
		}
	});
	
	jq('.movedown').click(function(){
		var tr = jq(this).parents('TR');
		var nextTr = tr.next();
		
		if (nextTR.size()) {
			var order = tr.find(':hidden').val();
			tr.remove().insertAfter(nextTR);
			nextTR.find(':hidden').val(order);
			tr.find(':hidden').val(order- 1);
		}
	});
	
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
				<td width="30px">\
					<div class="btn-group btn-group-vertical">\
						<a name="#" class="btn moveup"><i class="icon-arrow-up"></i></a>\
						<a name="#" class="btn movedown"><i class="icon-arrow-down"></i></a>\
					</div>\
				</td>\
				<td style="width: <?= PictureSize::thumbnail()->getWidth()?>px"><img src="' + data.item.url+ '"></td>\
				<td><b>' + data.item.realty_code + '</b> : ' + data.item.name + '</td>\
				<td class="pull-right">\
					<input type="hidden" name="item[' + data.item.realty_id + ']" value="' + itemListTotal + '"/>\
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
