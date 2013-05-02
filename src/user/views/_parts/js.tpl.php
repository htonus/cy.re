<?php
/*
 * $Id$
 *
 * expect:
 *	- $name
 */


	if (!is_array($name)) {
		$name = array($name);
	}

	foreach ($name as $script) {
		$file = PATH_SOURCE.'webroot/js/'.$script.'.js';

		if (file_exists($file)) {
			$time = filemtime($file);
?>
	<script type="text/javascript" src="<?=PATH_WEB_JS.$script?>.js?<?=$time?>"></script>
<?php
		}
	}