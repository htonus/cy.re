<?php
/**
 * $Id$
 */
?>

		<div class="control-group">
			<label class="control-label" for="input_offerType">Offer Type</label>
			<div class="controls">
				<select name="offerType" id="input_offerType">
					<option value="">Please select...</option>
<?php
	$default = $form->getValue('offerType')
		? $form->getValue('offerType')->getId()
		: null;
		
	foreach ($offerTypeList as $item) {
?>
					<option value="<?=$item->getId()?>"<?=$default == $item->getId() ? ' selected="selected"' : null?>><?=$item->getName()?></option>
<?php
	}
?>
				</select>
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
