<?php
/*
 * $Id$
 */

	$url = '/index.php?area='.$area
		.(empty($search) ? $search = '' : '&search='.$search)
		.'&action=';
?>
	<h1>Items of type: <?=ucfirst($area)?></h1>

	<form class="" action="<?= PATH_WEB_ADMIN?>" method="get">
		<input type="hidden" name="area" value="<?= $area?>" />
		<input type="hidden" name="action" value="<?= $action?>" />
	<div class="navbar">
		<div class="navbar-inner">
			<span class="brand">Filter</span>
			<ul class="nav">
				<li><a name="">Text to search</a></li>
				<li class="navbar-search">
					<input type="text" name="search" value="<?= $search ?>" class="input-medium search-query">
				</li>
				<li>&nbsp;</li>
				<li>
					<button type="submit" class="btn">Search</button>
				</li>
			</ul>
			<div class="pull-right">
				<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a>
			</div>
		</div>
	</div>
	</form>
	
<?php

	$partViewer->view('_parts/pager', $pager->set('url', $url.'index'));
	
?>
	
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Token / Text</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach ($list as $item) {
?>
		<tr>
			<td>
				<a href="<?=$url?>edit&id=<?=$item->getId()?>" style="font-family: monospace;"><?= $item->getName(); ?></a>
				<br/>
				<?= StringHelper::me()->cutText($item->getValue(), 100); ?>
			</td>
			<td>
				<a href="<?=$url?>edit&id=<?=$item->getId()?>">edit</a> |
				<a href="<?=$url?>drop&id=<?=$item->getId()?>">drop</a>
			</td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>
	<a class="btn btn-success pull-right" href="<?=$url?>edit">Add new</a><br />

<?php

	$partViewer->view('_parts/pager', $pager->set('url', $url.'index'));

