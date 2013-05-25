<?php
/*
 * $Id$
 */

	$partViewer->view('_parts/page_title');

?>
<script type="text/javascript">
jq(document).ready(function(){
	jq('.preview').click(function(){
		jq('.preview').parent().css('background', "none");
		jq('.preview').css({opacity: 1});

		jq(this).parent().css('background', "#000");
		jq(this).animate({opacity: 0.5});
		var src = jq('#picture').attr('src').replace(/[^\/]+$/, jq(this).attr('src').match(/[^\/]+$/));

		jq('#picture').animate(
			{opacity: 0},
			function(){
				jq('#picture').attr('src', src);
				jq('#picture').animate({opacity: 1});
			}
		);
	});
});
</script>
	<section>

		<div class="container">
			<div class="row">

				<div class="span8 mt20">

					<img src="<?= PictureSize::big()->getUrl($realty->getPreview())?>" id="picture" />

					<div class="row hidden-phone">
<?php
	foreach ($realty->getPictures()->getList() as $item) {
?>
						<div class="span2 mt20">
							<img src="<?= PictureSize::preview()->getUrl($item)?>" class="preview" />
						</div>
<?php
	}
?>
					</div>

				</div>

				<div class="span4 mt20">

					<div class="well">
						<div><h4>Summer Time</h4><div class="meta"><span> <strong>&lt; <a href="http://html.orange-idea.com/builder/portfolio-type/somthing/" rel="prev">Somthing</a></strong> </span> <span class="last_item"></span></div></div>
						<h6 style="font-weight:600 !important; text-transform:uppercase !important">WebSite: <a class="link" href="">www.somesite.com</a></h6>
						<p class="small">Nearly a third of all bottled drinking water purchased in the US is contaminated with bacteria.</p>
						<h6 style="font-weight:600 !important; text-transform:uppercase !important">Som words about</h6>
						<p>Venis potest flens ibidem quod eam in. Ambo una litus vita Apolloni codicellos iam custodio vocem magno dies tuum abscondere.</p>
						<div class="separator_dash"></div>
						<h6 style="font-weight:600 !important; text-transform:uppercase !important">Was done</h6>
						<p class=" nobottommargin">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.<br><br> <span class="small-italic">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English.</span></p>
					</div>

				</div>

			</div>
		</div>

	</section>