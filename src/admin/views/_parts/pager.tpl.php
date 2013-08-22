<?php
/*
 * $Id$
 */

if (empty($pages) || $pages < 2)
	return $this;

$url .= '&page=';
?>

<div class="pagination pagination-large" align="center">
	<ul>
		<li><a <?= $page == 1 ? 'name="prev"' : 'href="'.$url.($page - 1).'"'?>>&lt;&lt;</a></li>
<?php
	

	// First part
	if ($pages < 11)
		$max = $pages;
	elseif ($page <= 5 || $page > $pages - 5)
		$max = 5;
	else
		$max = 3;
	
	for ($i = 1; $i <= $max ; $i ++) {
?>
		<li><a <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a></li>
<?php
	}
	
	
	
	// first delimiter dots
	if ($pages > 11) {
?>
		<li><a name="delim1">&middot;&middot;&middot;</a></li>
<?php
	}
	
	
	
	// Middle part
	if ($pages > 11 && $page + 5 <= $pages) {
		$start = $page - 1;
		for ($i = $page - 1; $i <= $page + 1 ; $i ++) {
?>
		<li><a <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a></li>
<?php
		}
	}
	
	
	// second delimiter dots
	if ($pages > 11 && $page + 5 <= $pages) {
?>
		<li><a name="delim1">&middot;&middot;&middot;</a></li>
<?php
	}

	
	
	// Last part
	if ($pages > 11) {
		if ($page + 5 <= $pages)
			$max = 3;
		else
			$max = 5;
		
		for ($i = $pages - $max + 1; $i <= $pages ; $i ++) {
?>
		<li><a <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a></li>
<?php
		}
	}
?>
	
		<li><a <?= $page == $pages ? 'name="next"' : 'href="'.$url.($page + 1).'"'?>>&gt;&gt;</a></li>
	</ul>
</div>