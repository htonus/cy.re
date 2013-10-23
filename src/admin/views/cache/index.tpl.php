<?php
/*
 * $Id$
 */


?>

<h2>Actions</h2>

<?php
	$partViewer->view('_parts/form/flash');
?>

<div class="row">
	<div class="span3">
		<a class="btn btn-large input-block-level" href="/index.php?area=cache&action=clean">Clean picture cache</a>
	</div>
	<div class="span6">
		This command to cleanup all picture cache, in case if you noticed that some pictures shows unexpected view.<br/>
		<i>Affects only cache. All information remain intact.</i><br/>
		<b>Warning:</b> will slow down the server until the cache will be restored<br/>
	</div>
</div>

<hr>

<div class="row">
	<div class="span3">
		<a class="btn btn-large input-block-level" href="/index.php?area=cache&action=check_db">Check picture data integrity</a>
	</div>
	<div class="span6">
		This command to compares database records with physical picture storage and seeks possible corruption.<br/>
		<i>Affects nothing. All information remain intact.</i><br/>
		<b>Warning:</b> Run this command before start Synchronization process!<br/>
	</div>
</div>

<hr>

<div class="row">
	<div class="span3">
		<a class="btn btn-large input-block-level" href="/index.php?area=cache&action=check_fs">Check physical storage</a>
	</div>
	<div class="span6">
		This command compares physical picture storage with database records and <u>deletes</u> possible corruption.<br/>
		<i>Affects nothing. All information remain intact.</i><br/>
		<b>Warning:</b> Run this command before start Synchronization process!<br/>
	</p>
</div>