<?php
/**
 * $Id$
 */
	
	$partViewer->view(
		'_parts/js',
		Model::create()->set('name', array(
			'ui-widget.min',
			'tmpl.min',
			'load-image.min',
			'canvas-to-blob.min',
			'iframe-transport.min',
			'fileupload.min',
			'image_loader',
		))
	);
?>
<style>
#fileContainer {
	border: 1px solid #DDD;
	min-height: 300px;
	overflow-y: scroll;
	overflow-wrap: normal;
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

<input type="file" name="file[]" id="fileButton" multiple style="display: none;"/>
<label for="images">Property Images (drag & drop in the field below or <span id="fileTrigger">press here</span> to add)</label>
<div id="fileContainer"></div>

<script type="text/x-tmpl" id="tmplUpload">
<div class="file" id="file_{%= '' + o.file.id %}">
	<div class="control-group">
		<div class="control-label preview"></div>
		<div class="controls">
			<div class="input">
				<div class="file_name">Name: {%= o.file.name %}</div>
				<div class="file_size">Size: {%= (o.file.size >> 20 > 0) ? (o.file.size >> 20) + ' M' : (o.file.size >> 10) + ' k' %}</div>
				<input type="checkbox" style="display: none" name="file_main" value="{%=o.file.name%}" />
				<textarea name="file_note[{%=o.file.name%}]" class="input-block-level" rows="2"></textarea>
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-small btn-success make-main">Image for Preview</button>
					<button type="button" class="btn btn-small btn-danger drop">Delete</button>
				</div>
			</div>
		</div>
	</div>
</div>
</script>