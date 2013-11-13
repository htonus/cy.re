<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);

	if (empty($activeTabName)) {
		if ($id)
			$activeTabName = 'pictures';
		else
			$activeTabName = 'description';
	}

	$tabList = array(
		'description'	=> 'Description',
		'features'		=> 'Features',
		'pictures'		=> 'Pictures',
		'owner'			=> 'Owner'
	);
?>

<h1><?=$id ? 'Update Realty site: '.$form->getValue('id')->getName() : 'Add new Realty site'?></h1>

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
<?php
	foreach ($tabList as $tabName => $tabTitle) {
?>
			<li<?= $tabName == $activeTabName ? ' class="active"' : null ?> id="navtab_<?=$tabName?>"><a href="#tab_<?= $tabName?>" data-toggle="tab"><?= $tabTitle; ?></a></li>
<?php
	}
?>
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

<?php
	foreach ($tabList as $tabName => $tabTitle) {
?>
	<div class="tab-pane<?= $tabName == $activeTabName ? ' active' : null ?>" id="tab_<?= $tabName; ?>">
<?php
	$partViewer->view('realty/parts/'.$tabName);
?>
	</div>
<?php
	}
?>

</div>

</form>

</div>


<script type="text/javascript">
var filtered = false;
var allowed = true;

jq(document).keyup(function(e){
	if (jq('#tab_features .tab-content .active').size() > 0) {
		if (e.keyCode == 27) {
			jq(document).focus();
		}
		
		if (filtered) {
			jq('#tab_features .tab-content .active .span4').show();
			filtered = false;
		}
		
		if (
			!e.target.tagName.match(/input/i)
			|| jq(this).attr('type') != 'text'
			|| (e.keyCode > 64 && e.keyCode < 91)
			|| (e.keyCode > 95 && e.keyCode < 123)
		) {
			var char = String.fromCharCode(e.which || e.keyCode).toLowerCase();
			
			jq('#tab_features .tab-content .active LABEL').each(function(){
				if (jq(this).text().trim().match(eval('/^[^' + char + ']/i'))) {
					jq(this).parents('.span4').hide();
				}
			});
			
			filtered = true;
		}
	}
});

jq('#fileupload').submit(function(){
	if (filtered) {
		jq('#tab_features .tab-content .span4').show();
		filtered = false;
	}
});
</script>
