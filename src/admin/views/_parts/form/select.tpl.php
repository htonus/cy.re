<?php
/**
 * Expect:
 * $list - Identifiers list
 * $value - $id of the active option or null
 */
?>

<select class="nav nav-list bs-docs-sidenav affix-top">
<?php
	foreach ($list as $item) {
?>
	<option value="<?= $item->getId()?>"<?= $item->getId() == $value ? ' selected="selected"' : ''?>><?=$item->getName()?></option>
<?php
	}
?>
</select>