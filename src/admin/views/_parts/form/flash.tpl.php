<?php
/**
 * Expect:
 * $list - Identifiers list
 * $value - $id of the active option or null
 */
?>

<script type="text/javascript">
jq(document).ready(function(){
	jq(".alert .close").click(function(){
		jq(this).parent().slideUp("slow");
	});
});
</script>
<?php
foreach (Session::getAll() as $key => $value) {
	if (preg_match('|^flash\.(.*)$|i', $key, $m)) {
?>
	<div class="alert alert-<?= $m[1]?>"><?= $value?><button type="button" class="close">×</button></div>
<?
		Session::drop($key);
	}
}
