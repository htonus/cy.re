<?php
/*
 * $Id$
 */


?>


<?php
	$partViewer->view('_parts/form/flash');
?>


<?php
	if (empty($missedPictures)) {
?>

<h2>No data data corruption found</h2>

<div class="row">
	<div class="span3">
		<a class="btn btn-large btn-success input-block-level" href="/index.php?area=cache">Back to menu list</a>
	</div>
	<div class="span6">
		Everything is ok. No data corruption detected! Cheers!
	</div>
</div>
	
<?php
	} else {
?>

<h2>Found possible data corruption:</h2>

<?php
		foreach ($missedPictures as $picture) {
?>

<div class="row">
	<div class="span9">
		Picture ID: <b><?= $picture?></b>
	</div>
</div>

<?php
		}
?>

<hr>

<div class="row">
	<div class="span3">
		<a class="btn btn-large btn-danger input-block-level" href="/index.php?area=cache&action=sync_fs">Fix data integrity</a>
	</div>
	<div class="span6">
		This command to synchronize physical picture storage with database records and <u>deletes</u> orphaned files.<br/>
		<i class="red">Affects physical picture storage.</i><br/>
		<b>Warning:</b> Proceed this command only after <a href="/index.php?area=cache&action=check_fs">check</a> run!<br/>
	</div>
</div>
	
<?php
	}
