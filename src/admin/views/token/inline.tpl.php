<?php
/*
 * $Id$
 */
	
	$id = $form->getValue('id')
		? $form->getValue('id')->getId()
		: null;
	
	$class = get_class($subject);
	
	$partViewer->view('_parts/form/flash');

	if ($errors = $form->getErrors()) {
		print_r($errors);
	}
?>

<br/>

<form name="editInlineForm" id="inlineTokenForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="token" />
<input type="hidden" name="mode" value="inline" />
<input type="hidden" name="action" value="take" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="name" value="<?= $form->getValue('name'); ?>" />
<input type="hidden" name="object" value="<?= $form->getValue('object') ?>" />
<input type="hidden" name="objectId" value="<?= $form->getValue('objectId') ?>" />


<?php
	$partViewer->view('_parts/form/i18n_inline');
?>


<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" type="button" onclick="submitInlineForm(this.form)">Submit</button>
		<button class="btn" data-dismiss="modal" type="button">Cancel</button>
    </div>
</div>


</form>


<script type="text/javascript">
function submitInlineForm(form) {
	jq.getJSON(
		'/index.php?' + jq(form).serialize(),
		function(data){
			if (typeof inlineCallback == 'function') {
				inlineCallback(data);
			}
		}
	);
}
</script>