<?php
/**
 * $Id$
 */
?>
<style>
#fileContainer {
	border: 1px solid #DDD;
/*	min-height: 300px;
	overflow-y: scroll;
	overflow-wrap: normal;*/
}
#fileContainer > DIV {
	float: left;
	width: 45%;
	border: 5px solid #FFF;
	padding: 5px;
}
#fileContainer > DIV:nth-child(odd) {
	clear: both;
}
.file .preview {
	text-align: center;
}
.highlite {
	border: 1px solid #090 !important;
}
.file .control-group {
	margin-bottom: 0px;
}
</style>

<div id="fileContainer">
<?php
	$list = $form->getValue('id')
		? $form->getValue('id')->getPictures()->getList()
		: array();

	foreach ($list as $item) {
?>
	<div class="file" id="file_<?=$item->getId()?>">
		<div class="control-group">
			<div class="control-label preview"></div>
			<div class="controls">
				<div class="input">
					<div>Name: <?=$item->getName()?></div>
					<div>Size: <?=$item->getSize()?></div>
					<div>Description:<br/><?=$item->getSize()?></div>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-small btn-success make-main">Image for Preview</button>
						<button type="button" class="btn btn-small btn-danger drop">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
?>
</div>
