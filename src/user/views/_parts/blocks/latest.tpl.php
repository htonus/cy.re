<?php
/**
 *
 */

	if (empty($latestList))
		return $this;
?>
		<div class="container latest">
			<div class="row">
<?php
	reset($latestList);
	$count = count($latestList);
	
	$icons = array(
		PATH_WEB_IMG.'icons/admin.png',
		PATH_WEB_IMG.'icons/frame.png',
		PATH_WEB_IMG.'icons/ipad.png',
		PATH_WEB_IMG.'icons/admin.png',
		PATH_WEB_IMG.'icons/frame.png',
		PATH_WEB_IMG.'icons/ipad.png',
	);
	
	for ($i = 0; $i < $count; $i++) {
		$item = current($latestList);
		$key = key($latestList);
		$icon = $item->getCategory() && $item->getCategory()->getIconUrl()
			? $item->getCategory()->getIconUrl()
			: next($icons);
?>
				<div class="span<?= floor(12 / $count)?>">
<?php
	$partViewer->view(
		'_parts/admin-bar',
		$model->set(
			'adminUrl',
			'?area=article&action=edit&id='.$item->getId()
		)
	);
?>
					<a href="<?= PATH_WEB.Section::info()->getSlug().'/item/'.$item->getId() ?>" class="black">
						<div class="block">
							<h4>
								<img title="latest_<?= $i?>" src="<?= $icon?>" alt="" width="25" height="25">
								<?= $item->getName() ?>
							</h4>
							<div class="clearfix"></div>
							<p><?= $item->getBrief()?></p>
						</div>
					</a>
				</div>
<?php
		if (!next($latestList))
			break;
	}
?>
			</div>
		</div>
