<?php
/*
 * $Id$
 */

if (empty($pages) || $pages < 2)
	return $this;

$url .= '&page=';
?>
	<div class="pager">
		<a class="btn btn-small btn-black" <?= $page == 1 ? 'name="prev"' : 'href="'.$url.($page - 1).'"'?>>&lt;&lt;</a>
<?php
	

	// First part
	if ($pages < 11)
		$max = $pages;
	elseif ($page <= 5 || $page > $pages - 5)
		$max = 3;
	else
		$max = 5;
	
	for ($i = 1; $i <= $max ; $i ++) {
?>
		<a class="btn btn-black btn-small <?= $i == $page ? 'active' : ''?>" <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a>
<?php
	}
	
	
	
	// first delimiter dots
	if ($pages > 11) {
?>
		<a class="btn btn-small btn-black" name="delim1">&middot;&middot;&middot;</a>
<?php
	}
	
	
	
	// Middle part
	if ($pages > 11 && $page + 5 <= $pages) {
		$start = $page - 1;
		for ($i = $page - 1; $i <= $page + 1 ; $i ++) {
?>
		<a class="btn btn-small btn-black <?= $i == $page ? 'active' : ''?>" <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a>
<?php
		}
	}
	
	
	// second delimiter dots
	if ($pages > 11 && $page + 5 <= $pages) {
?>
		<a class="btn btn-small btn-black" name="delim1">&middot;&middot;&middot;</a>
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
		<a class="btn btn-small btn-black <?= $i == $page ? 'active' : ''?>" <?= $i == $page ? 'name="current"' : "href=\"$url$i\"" ?>><?= $i == $page ? "<b>$i</b>" : $i ?></a>
<?php
		}
	}
?>
	
		<a class="btn btn-small btn-black" <?= $page == $pages ? 'name="next"' : 'href="'.$url.($page + 1).'"'?>>&gt;&gt;</a>
	</div>