<?php
/**
 * shared template
 */

	$partViewer->view('_parts/js', Model::create()->set('name', 'wysiwyg-html5.0.3.0'));
	$partViewer->view('_parts/js', Model::create()->set('name', 'wysiwyg-rules'));
?>
<script type="text/javascript">
function attachEditor(textarea)
{
	jq("iframe.wysihtml5-sandbox, input[name='_wysihtml5_mode']").remove();
	jq("body").removeClass("wysihtml5-supported");

	jq('TEXTAREA[id!=' + textarea + ']').css('display', 'block');

	var toolbar = jq('#toolbar');
	jq(toolbar.clone()).prependTo(jq('#' + textarea).parent());
	toolbar.remove();

	window.editor = new wysihtml5.Editor(textarea, {
		toolbar:      "toolbar",
		stylesheets:  ["<?=PATH_WEB_CSS?>bootstrap.min.css", "<?=PATH_WEB_CSS?>bootstrap-responsive.min.css", "<?=PATH_WEB_CSS?>main.css"],
		parserRules:  wysihtml5ParserRules,
		useLineBreaks: false
	});
}
</script>

<div id="toolbar" style="display: none; width: 670px">
	<div class="btn-group">
		<a data-wysihtml5-command="bold" title="CTRL+B" class="btn"><i class="icon-bold"></i></a>
		<a data-wysihtml5-command="italic" title="CTRL+I" class="btn"><i class="icon-italic"></i></a>
		<a data-wysihtml5-command="underline" title="CTRL+U" class="btn"></i><u><b>U</b></u></a>
		<div class="btn-group">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				Colors
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red"><span class="badge badge-important">&nbsp;</span> Red</a></li>
				<li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green"><span class="badge badge-success">&nbsp;</span> Green</a></li>
				<li><a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue"><span class="badge badge-info">&nbsp;</span> Blue</a></li>
			</ul>
		</div>
	</div>
	<div class="btn-group">
		<a data-wysihtml5-command="justifyLeft" class="btn"><i class="icon-align-left"></i></a>
		<a data-wysihtml5-command="justifyCenter" class="btn"><i class="icon-align-center"></i></a>
		<a data-wysihtml5-command="justifyRight" class="btn"><i class="icon-align-right"></i></a>
		<a data-wysihtml5-command="justifyFull" class="btn"><i class="icon-align-justify"></i></a>
		<div class="btn-group">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				Style
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="P" alt="insert paragraph">Paragraph</a></li>
				<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" alt="insert headline 1">Headline 1</a></li>
				<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" alt="insert headline 2">Headline 2</a></li>
				<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" alt="insert headline 3">Headline 3</a></li>
				<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" alt="insert headline 4">Headline 4</a></li>
			</ul>
		</div>
	</div>
	<!-- div class="btn-group">
		<a data-wysihtml5-command="createLink"class="btn"><i class="icon-share"></i></a>
		<a data-wysihtml5-command="insertImage" class="btn"><i class="icon-picture"></i></a>
	</div -->
	<div class="btn-group">
		<a data-wysihtml5-command="insertUnorderedList" class="btn" alt="unordered list"><i class="icon-list"></i></a>
		<a data-wysihtml5-command="insertOrderedList" class="btn" alt="ordered list"><i class="icon-th-list"></i></a>
	</div>

	<a data-wysihtml5-action="change_view" class="btn pull-right" alt="switch to html view"><i class="icon-edit"></i></a>
	<button class="btn pull-right" alt="cleanup" onlick="cleanupEditor()"><i class="icon-remove"></i></button>
	
	<div data-wysihtml5-dialog="createLink" style="display: none;" class="input-append input-prepend breadcrumb">
		<span class="add-on span1">&nbsp; Link &nbsp;</span>
		<input class="span3" type="text" data-wysihtml5-dialog-field="href" value="http://" />
		<a class="btn" data-wysihtml5-dialog-action="save">OK</a>
		<a class="btn" data-wysihtml5-dialog-action="cancel">Cancel</a>
	</div>

	<div data-wysihtml5-dialog="insertImage" style="display: none;" class="form-inline input-append breadcrumb">
		<div class="input-prepend">
			<span class="add-on span1">&nbsp; Image &nbsp;</span>
			<input class="span3" type="text" data-wysihtml5-dialog-field="src" value="http://" />
		</div>
		<div class="input-prepend">
			<span class="add-on span1">&nbsp; Align &nbsp;</span>
			<select data-wysihtml5-dialog-field="className">
				<option value="" selected="selected">No align</option>
				<option value="wysiwyg-float-left">left</option>
				<option value="wysiwyg-float-right">right</option>
			</select>
		</div>
		<a class="btn" data-wysihtml5-dialog-action="save">OK</a>
		<a class="btn" data-wysihtml5-dialog-action="cancel">Cancel</a>
	</div>

</div>
