<?php
/*
 * $Id$
 */

	if (empty($title))
		return;
		
	if (empty($subtitle))
		$subtitle = '';
	else
		$subtitle = ' <strong>:</strong> '.$subtitle;
		
?>

<div class="page-title">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>
					<?= $title.$subtitle ?>
				</h3>
				<div class="gradus">
					<a class="subpage_block" href="/">Home</a> / <span class="/buy">buy</span>
				</div>
			</div>
		</div>
	</div>
</div>
