<?php
/**
 *
 */
?>
		<div class="container extra">

			<div class="row">
				<div class="span12"><h3><?= $promote->getName(); ?></h3></div>
			</div>

<?php
	$partViewer->view(
		'_parts/admin-bar',
		$model->set(
			'adminUrl',
			'?area='.Section::getByType($promote->getType()).'&action=edit&id='.$promote->getId()
		)
	);
?>
			<div class="row">

				<div class="span6">

					<img src="<?= PATH_WEB_IMG ?>logo-about.gif" class="pull-left" style="margin-right: 10px">

					<p><?= mb_ereg_replace("\n", '</p><p>', $promote->getBrief()); ?></p>

					<div class="hr mt20" style="height: 1px;">
					
					<div class="pull-left">
						<b><?= $promote->getPublished()->toDate(); ?></b>
					</div>

					<div class="pull-right">
						<a href="/read/item/<?= $promote->getId()?>">read more</a>
					</div>
					</div>

					<!-- a href="#" class="btn pull-right"><i class="icon-download"></i> Download our Brochure</a -->

					<!-- div class="bloquote">
						<h4>Clients Testimonials</h4>
						<p>
							In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. The readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content.
						</p>
						<i>Mikle / CEO Some Company</i>
					</div -->

				</div>

				<div class="span6">
<?php
	if ($preview = $promote->getPreview()) {
?>
					<div><img src="<?= PictureSize::list1()->getUrl($preview); ?>" width="100%"></div>
<?php
	}

/*
					<h3>Esperia Group of companies:</h3>

					<div id="extraCarousel">
						<img src="<?= PATH_WEB_IMG?>newone.jpg"/>
					</div>

					<div class="note">
						<div class="title">
							<div class="date">
								<i class="icon-calendar icon-white"></i>
								17 Apr, 2013
							</div>
							<h4>Post + Right Sidebar</h4>
							<span>BY SOMEONE / 123 COMMENTS /</span>
						</div>

						<p>
							Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget ...
						</p>

						<a href="#"><i class="icon-chevron-right icon-white"></i> Read More</a>
					</div>
				</div>

 */
?>

			</div>
		</div>
