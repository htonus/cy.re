<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
?>

<h1><?=$id ? 'Update Realty site: '.$form->getValue('id')->getName() : 'Add new Realty site'?></h1>

<?php
	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form
	name="editForm"
	action="/index.php"
	method="post"
	class="form-horizontal"
	id="fileUpload"
	enctype="multipart/form-data"
>

<input type="hidden" name="area" value="<?=$area?>" />
<input type="hidden" name="action" value="<?=$id ? 'save' : 'add'?>" />
<input type="hidden" name="id" value="<?=$id?>" />

<div class="navbar">
	<div class="navbar-inner">
		<b class="brand">Sections</b>
		<ul class="nav nav-tabs">
			<li><a href="#tab_description" data-toggle="tab">Description</a></li>
			<li><a href="#tab_features" data-toggle="tab">Features</a></li>
			<li class="active"><a href="#tab_pictures" data-toggle="tab">Pictures</a></li>
		</ul>
		<div class="controls pull-right">
			<button class="btn" type="button" onclick="document.location.href='/index.php?area=language'">Cancel</button>
			<button class="btn btn-primary" type="button" id="btnSubmit">Submit</button>
		</div>
	</div>
</div>


<div class="tab-content">
	
	<div class="tab-pane" id="tab_description">
<?php
	$partViewer->view('_parts/form/i18n');
	$partViewer->view('realty/parts/main');
?>
	</div>

	
	<div class="tab-pane" id="tab_features">
<?php
	$partViewer->view('realty/parts/features');
?>
	</div>
	
	<div class="tab-pane active" id="tab_pictures">
<?php
	$partViewer->view('realty/parts/pictures');
?>
	</div>
	
</div>

</form>

</div>

<script type="text/javascript">
jq(document).ready(function(){
	jq('#btnSubmit').click(function(){
		var form = jq(this).get(0).form;
		var data = {};

		jq('INPUT:text, TEXTAREA, INPUT["name^=feature["]:checked', jq('#fileupload')).each(function(){
			data[jq(this).attr('name')] = jq(this).val();
		});

		jq.post(
			'/index.php?area=<?=$area?>&action=<?=$form->getValue('id') ? 'save' : 'add'?>',
			data,
			function(result){
				if (result.result == '<?=PrototypedEditor::COMMAND_SUCCEEDED?>') {
					var notes = {};
					jq('DIV.file :text').each(function(i, obj){
						var name = jq(obj).attr('name').match(/\[([^\]]+)\]/);
						notes[name[1]] = jq(obj).val();
					});

					var formData = {
						property	: result.id,
						comments	: JSON.stringify(notes),
						file_main	: jq('DD.file :checked').val()
					};

					ImageLoader.uploadFiles(formData, function(result){
						if (result.result == '<?=PrototypedEditor::COMMAND_SUCCEEDED?>')
							document.location.href = result.url;
						else
							alert('Something went wrong!');
					});
				} else {
					// property editor error
				}
			}
		);
	});
});
</script>