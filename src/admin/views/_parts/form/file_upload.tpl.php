
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->

<?php
	
	$partViewer->view(
		'_parts/css',
		Model::create()->set('name', array(
			'jquery.fileupload-ui',
			'jquery.fileupload-ui-noscript'
		))
	);
	
	$partViewer->view(
		'_parts/js',
		Model::create()->set('name', array(
			'tmpl.min',				// The Templates plugin is included to render the upload/download listings
			'jquery.ui.widget',		// The jQuery UI widget factory, can be omitted if jQuery UI is already included
			'load-image.min',		// The Load Image plugin is included for the preview images and image resizing functionality
			'canvas-to-blob.min',	// The Canvas to Blob plugin is included for image resizing functionality
			'jquery.fileupload',	// The basic File Upload plugin
			'jquery.fileupload-fp',	// The File Upload file processing plugin
			'jquery.fileupload-ui',	// The File Upload user interface plugin
//			'fu-main',				// The main application script
			'bootstrap-image-gallery.min',	// Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo
			'jquery.iframe-transport',		// The Iframe Transport is required for browsers without support for XHR file uploads
		))
	);
?>
<script type="text/javascript">
jq(document).ready(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    jq('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/?area=<?= $area?>&action=add_pictures&id=<?=$form->getValue('id')->getId()?>',
        list_url: '/?area=<?= $area?>&action=get_pictures&id=<?=$form->getValue('id')->getId()?>',
		previewMaxWidth: <?=  PictureSize::thumbnail()->getWidth()?>,
		previewMaxHeight: <?=  PictureSize::thumbnail()->getHeight()?>,
		prependFiles: true,
    });
	
    // Enable iframe cross-domain access via redirect option:
    jq('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

	// Load existing files:
	jq.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: jq('#fileupload').fileupload('option', 'list_url'),
		dataType: 'json',
		context: jq('#fileupload')[0]
	}).done(function (result) {
		jq(this).fileupload('option', 'done')
			.call(this, null, {result: result});
	});

});

function togglePreviewPicture(btn)
{
	var button = btn;
	jq.getJSON(
		jq(button).attr('data-url'),
		function(data) {
			if (data.success == true) {
				jq(button).remove();
				jq('.template-download').animate({'background-color': '#6G6'});
			} else {
				alert('Can not change preview picture');
			}
		}
	);
}
</script>


	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
	<div class="row fileupload-buttonbar">
		<div class="span6">
			<!-- The fileinput-button span is used to style the file input field as button -->
			<span class="btn btn-success fileinput-button">
				<i class="icon-plus icon-white"></i>
				<span>Add files...</span>
				<input type="file" name="files[]" multiple>
			</span>
			<button type="submit" class="btn btn-primary start">
				<i class="icon-upload icon-white"></i>
				<span>Start upload</span>
			</button>
			<button type="reset" class="btn btn-warning cancel">
				<i class="icon-ban-circle icon-white"></i>
				<span>Cancel upload</span>
			</button>
			<button type="button" class="btn btn-danger delete">
				<i class="icon-trash icon-white"></i>
				<span>Delete</span>
			</button>
		</div>
		<!-- The global progress information -->
		<div class="span3 fileupload-progress fade">
			<!-- The global progress bar -->
			<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				<div class="bar" style="width:0%;"></div>
			</div>
			<!-- The extended global progress information -->
			<div class="progress-extended">&nbsp;</div>
		</div>
	</div>
	<!-- The loading indicator is shown during file processing -->
	<div class="fileupload-loading"></div>
	<br>
	<!-- The table listing the files available for upload/download -->
	<table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
	<td class="preview"><span class="fade"></span></td>
        <td>
			<div class="name">{%=file.name%}</div>
			<div class="size">{%=o.formatFileSize(file.size)%}</div>
			<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
		</td>
{%	if (file.error) { %}
            <td class="error"><span class="label label-important">Error</span> {%=file.error%}</td>
{%	} else { %}
            <td></td>
{%	} %}
        <td style="text-align: right;">
			<div class="btn-group btn-group-vertical">
{%	if (!i) { %}
{%		if (o.files.valid && !o.options.autoUpload) { %}
				<button class="btn btn-primary btn-small start span2">
					<i class="icon-upload icon-white"></i>
					<span>Start</span>
				</button>
{%		} %}
				<button class="btn btn-warning btn-small cancel span2">
					<i class="icon-ban-circle icon-white"></i>
					<span>Cancel</span>
				</button>
{%	} %}
			</div>
		</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
{%	if (file.error) { %}
			<td>
				<div class="name"><span>{%=file.name%}</span></div>
				<div class="size"><span>{%=o.formatFileSize(file.size)%}</span></div>
			</td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
{%	} else { %}
            <td class="preview" style="width: <?=  PictureSize::thumbnail()->getWidth()?>px">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
			<td>
				<div class="name"><a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a></div>
				<div class="size"><span>{%=o.formatFileSize(file.size)%}</span></div>
			</td>
            <td></td>
{%	} %}
        <td style="text-align: right;">
			<div class="btn-group btn-group-vertical">
{%		if (file.preview_url) { %}
				<button class="btn btn-small span1 btn-info" onclick="togglePreviewPicture(this)" data-url="{%=file.preview_url%}" type="button">Preview</button>
{%		} %}
				<button class="btn btn-small span1 btn-success">Edit Text</button>
				<button class="btn btn-small span1 btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
			</div>
        </td>
    </tr>
{% } %}
</script>