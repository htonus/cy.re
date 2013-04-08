<?php
/**
 * $Id$
 */
?>

		<div class="control-group">
			<label class="control-label" for="input_offerType">Offer Type</label>
			<div class="controls">
<?php
	$default = $form->getValue('offerType')
		? $form->getValue('offerType')->getId()
		: null;
	
	foreach ($offerTypeList as $item) {
?>
				<label class="radio inline">
					<input type="radio" name="offerType" id="offerType<?=$item->getId()?>" value="<?=$item->getId()?>" <?=$default == $item->getId() ? 'checked="checked"' : null?>>
					<?=$item->getName()?>
				</label>
<?php
	}
?>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_realtyType">Realty Type</label>
			<div class="controls">
				<select name="realtyType" id="input_realtyType">
<?php
	$default = $form->getValue('realtyType')
		? $form->getValue('realtyType')->getId()
		: null;
		
	foreach ($realtyTypeList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?=$item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_realtyType">City</label>
			<div class="controls">
				<select name="city" id="input_city">
					<option value=""></option>
<?php
	$default = $form->getValue('city')
		? $form->getValue('city')->getId()
		: null;

	foreach ($cityList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?=$item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>
