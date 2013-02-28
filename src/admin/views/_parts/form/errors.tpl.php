<?php
/**
 * Expect:
 * $form - form with textual errors
 */
?>

<div class="alert alert-error">
	<b>Errors:</b>
	<ul>
<?php
	$errors = $form->getTextualErrors() ? $form->getTextualErrors() : $form->getErrors();
	
	foreach ($errors as $key => $text) {
		if ($text === 1) {
			$text = 'Wrong value';
		} elseif ($text === 2) {
			$text = 'Missing required value';
		}
?>
		<li><?=$key.' - '.$text?></li>
<?php
	}
?>
	</ul>
</div>