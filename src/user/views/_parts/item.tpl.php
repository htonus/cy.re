<?php
/*
 * $Id$
 *
 * expect:
 *	- $name
 */


	$partViewer->view(
		'_parts/page_title',
		Model::create()->
			set('title', ucfirst($subject->getRealtyType()->getName()).' in '.$subject->getCity()->getName())->
			set('subtitle', null)
	);

	$pictureList = $subject->getPictures()->getList();

	$signs = array(
		'EUR'	=> '&euro;',
		'USD'	=> '&dollar;',
		'RUB'	=> '<strike>P</strike>',
		'GBP'	=> '&pound;',
		'CNY'	=> 'Ұ',
	);
	
	$partViewer->view('_parts/js', Model::create()->set('name', 'format.currency'));
?>

<script type="text/javascript">
var currencyRates = <?= json_encode($currencyRates, JSON_NUMERIC_CHECK)?>;

jq(document).ready(function(){
	jq('#currencyForPrice .badge').click(function(){
		var currencyBadge = jq(this);
		
		jq('#currencyForPrice .badge-active')
			.removeClass('badge-active')
			.addClass('badge-inactive');

		jq('SPAN.price').each(function(){
			jq(this).fadeOut('fast', function(){
				var currency = currencyBadge.attr('title');
				var price = parseFloat(jq(this).attr('data')) * currencyRates[currency]
				jq(this).numberFormat(price, currency);
				jq(this).fadeIn('fast');
			});
		});
		
		currencyBadge.addClass('badge-active');
	});
});
</script>

	<div class="section">

		<div class="container">
			<div class="row">

				<div class="span8 mt20">
<?php
	$partViewer->view(
		'_parts/widget/gallery',
		Model::create()->
			set('list', $subject->getPictures()->getList())->
			set('preview', $subject->getPreview())->
			set('perRow', 4)
	);
?>
				</div>

				<div class="span4 mt20">

					<div class="well">
						<div>
							<h4>
								<?= $subject->getName()?>
								<div class="green">
<?php
	if (
		!empty($user)
		&& $user->isAdmin()
	) {
?>
									<a href="<?= PATH_WEB_ADMIN?>?area=realty&action=edit&tab=description&id=<?= $subject->getId(); ?>" target="_blank"><small><b><?= $subject->getCode(); ?></b></small></a> : 
<?php
	} else {
?>
									<small><b><?= $subject->getCode(); ?></b></small> : 
<?php
	}
?>
									<?= ucfirst($subject->getRealtyType()->getName())?>  <?= $subject->getCity() ? ' in '.$subject->getCity()->getName() : null?>
								</div>
							</h4>
						</div>

						<table class="mb10">
						<tr>
							<td></td>
							<td id="currencyForPrice">
<?php
	foreach ($currencyRates as $currency => $rate) {
?>
								<span title="<?= $currency; ?>" class="badge <?= $currency == 'EUR' ? 'badge-active' : 'badge-inactive'?>"><?= $signs[$currency]; ?></span>
<?php
	}
?>
							</td>
						</tr>
<?php
	$group = FeatureTypeGroup::general();
	$featureList = $subject->getFeaturesByGroup($group);
	
	$vat = empty($featureList[FeatureType::VAT])
		? null
		: $featureList[FeatureType::VAT]->getType()->getView();
	
	unset($featureList[FeatureType::VAT]);
	
	foreach (FeatureType::getPriceTypes() as $typeId => $typeName) {
		if (empty($featureList[$typeId]))
			continue;
		
		$price = $featureList[$typeId];
?>
						<tr>
							<td align="right"><?= ucfirst($price->getType()->getName())?> : &nbsp;</td>
							<td>
								<span class="price" data="<?= $price->getValue()?>">EUR <?= number_format($price->getValue(), 0, '', "'") ?></span>
								<?= $vat; ?>
							</td>
						</tr>
<?php
	}
	
	unset($featureList[FeatureType::PRICE]);
	unset($featureList[FeatureType::PRICE_MONTHLY]);
	unset($featureList[FeatureType::PRICE_DAYLY]);
	
	foreach ($featureList as $featureId => $feature) {
		$value = Unit::TYPE_BOOL == $feature->getType()->getUnit()->getType()
			&& ($view = $feature->getType()->getView())
				? $view
				: $feature->getValue().' '.$feature->getType()->getSign();
?>
						<tr>
							<td align="right"><?= ucfirst($feature->getType()->getName())?> : &nbsp;</td>
							<td id="mainFeatures">
								<span id="type_<?= $featureId; ?>" data="<?= $feature->getValue()?>">
									<?= $value ?> 
								</span>
							</td>
						</tr>
<?php
	}

	if (
		(
			$subject->getLongitude()
			&& $subject->getLatitude()
		)
		|| (
			$subject->getCity()->getLongitude()
			&& $subject->getCity()->getLatitude()
		)
	) {
?>
						<tr>
							<td align="right">_S__LOCATION___ : &nbsp;</td>
							<td id="mainFeatures">
<?php
		$partViewer->view('_parts/widget/map');
?>
							</td>
						</tr>
<?php
	}
?>
						</table>

						<table width="100%">
						<tr valign="top">
							<td width="50%">

<?php
	$group = FeatureTypeGroup::indoor();
?>
								<h5 class="green mt20"><?= $group->getName()?></h5>
								<ul>
<?php
	foreach ($subject->getFeaturesByGroup($group) as $feature) {
?>
									<li><?= ucfirst($feature->getType()->getName())?></li>
<?php
	}
?>
								</ul>
							</td>
							<td width="50%">
<?php
	$group = FeatureTypeGroup::outdoor();
?>
								<h5 class="green mt20"><?= $group->getName()?></h5>
								<ul>
<?php
	foreach ($subject->getFeaturesByGroup($group) as $feature) {
?>
									<li><?= ucfirst($feature->getType()->getName())?></li>
<?php
	}
?>
								</ul>
							</td>
						</tr>
						</table>

						<div class="clearfix"></div>

						<div class="">
<?php
	$group = FeatureTypeGroup::distance();

	if ($list = $subject->getFeaturesByGroup($group)) {
?>
							<h5 class="green mt20"><?= $group->getName()?></h5>

							<table>
<?php
		foreach ($list as $feature) {
			$value = (int)$feature->getValue();
			$sign = $feature->getType()->getSign();
			$dec = 0;
			
			if ($value > 1000) {
				$value /= 1000;
				$sign = '_L__KM___';
				$dec = 1;
			}


?>
							<tr>
								<td align="right"><?= ucfirst($feature->getType()->getName())?> : &nbsp;</td>
								<td id="mainFeatures">
									<span id="type_<?= $featureId; ?>" data="<?= $feature->getValue()?>">
										<?= number_format($value, $dec, '.', "'") ?> <?= $sign ?>
									</span>
								</td>
							</tr>
<?php
		}
	}
?>
							</table>
						</div>

						<!-- distance group -->

						<div class="clearfix"></div>

						<a href="<?= PATH_WEB."$area/pdf/".$subject->getId()?>" target="_blank" class="btn btn-black input-block-level mt20">Download Property Booklet</a>
						
					</div>

				</div>

			</div>
			
			<div class="row">
				<div class="span12">
					<?= $subject->getText() ?>
				</div>
			</div>
		</div>

	</div>

