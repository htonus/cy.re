<?php
/**
 *
 */

	if (empty($list))
		return;
	
?>
		<div class="container extra">

			<div class="row">
				<div class="span12"><h3>___PROJECTS___</h3></div>
			</div>

			<div class="row">
<?php
	foreach ($list as $item) {
?>
				<div class="span6">
					<h4><?= $item->getName(); ?> &nbsp; </h4>

					<div class="row-fluid">
						<div class="span6">

							<p><?= mb_ereg_replace("\n", '</p><p>', $item->getBrief()); ?></p>

							<div class="hr mt20" style="height: 1px;">
								<div class="pull-left">
									<b>&nbsp;</b>
								</div>

								<div class="pull-right">
									<a href="/<?= $item instanceof Article ? Section::getByType($item->getType()) : $area ?>/item/<?= $item->getId()?>">read more</a>
								</div>
							</div>

						</div>

						<div class="span6">
							<div><img src="<?= PictureSize::list2()->getUrl($item->getPreview()); ?>" width="100%"></div>
						</div>
					</div>
					
				</div>
<?php
	}
?>

			</div>
		</div>
