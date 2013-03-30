<?php
/*
 * $Id$
 */

	if (!is_array($name)) {
		$name = array($name);
	}

	foreach ($name as $css) {
		$file = PATH_WEBROOT.'css'.DS.$css.'.css';

		if (file_exists($file)) {
			$time = filemtime($file);
?>
	<link rel="stylesheet" type="text/css" href=<?=PATH_WEB_CSS.$css?>.css?<?=$time?>" />
<?php
		}
	}