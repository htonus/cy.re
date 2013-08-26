<?php
/**
 *
 */

	if (empty($list))
		return $this;
?>
		<div class="container latest">
			<div class="row">
<?php
	reset($list);
	$count = count($list);
	
	$icons = array(
		PATH_WEB_IMG.'icons/admin.png',
		PATH_WEB_IMG.'icons/frame.png',
		PATH_WEB_IMG.'icons/ipad.png',
		PATH_WEB_IMG.'icons/admin.png',
		PATH_WEB_IMG.'icons/frame.png',
		PATH_WEB_IMG.'icons/ipad.png',
	);
	
	for ($i = 0; $i < $count; $i++) {
		$item = current($list);
		$key = key($list);
		$icon = $item->getCategory() && $item->getCategory()->getIconUrl()
			? $item->getCategory()->getIconUrl()
			: next($icons);
?>
				<div class="span<?= floor(12 / $count)?>">
					<div class="block">
						<h4>
							<img title="latest_<?= $i?>" src="<?= $icon?>" alt="" width="25" height="25">
							<?= $item->getName() ?>
						</h4>
						<div class="clearfix"></div>
						<p><?= $item->getBrief()?></p>
					</div>
				</div>
<?php
		if (!next($list))
			break;
	}
?>
			</div>
		</div>
