<?php
/**
 * Expect:
 * $list - Identifiers list
 * $value - $id of the active option or null
 */

	if ($subject instanceof Dated) {
?>
<div class="row">
	<div class="span4">Created: <b><?= $subject->getCreated() ? $subject->getCreated()->toFormatString('d M, Y') : '---'?></b></div>
<?php
		if ($subject instanceof Published) {
?>
	<div class="span4 pull-right" style="text-align: right">Published: <b><?= $subject->getPublished() ? $subject->getPublished()->toFormatString('d M, Y') : '---'?></b></div>
<?php
		}
?>
</div>
<?php
	}
