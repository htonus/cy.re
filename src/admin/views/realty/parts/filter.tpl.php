<?php
/**
 * $Id$
 */

	if (empty($filter))
		$filter = array();

	$urlHelper = UrlHelper::create($model);
?>
<br />

<h4>Filters:</h4>

<form action="" name="filterform" id="filterForm" method="get">
<input type="hidden" name="area" value="<?= $area?>" />
<input type="hidden" name="action" value="<?= $action?>" />

<div class="row-fluid">

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_city">City</label>
			<div class="controls">
				<select id="input_city" class="input-block-level" name="filter:city">
					<option value=""></option>
<?php
	$default = isset($filter['filter:city'])
		? $filter['filter:city']
		: null;
	
	foreach ($cityList as $item) {
?>
					<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_offer_type">Proposal</label>
			<div class="controls">
				<select id="input_offer_type" class="input-block-level" name="filter:offerType">
					<option value=""></option>
<?php
	$default = isset($filter['filter:offerType'])
		? $filter['filter:offerType']
		: null;
	
	foreach ($offerTypeList as $item) {
?>
					<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>
	</div>
	
</div>


<div class="row-fluid">

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_realty_type">Realty type</label>
			<div class="controls">
				<select id="input_realty_type" class="input-block-level" name="filter:realtyType">
					<option value=""></option>
<?php
	$default = isset($filter['filter:realtyType'])
		? $filter['filter:realtyType']
		: null;
	
	foreach ($realtyTypeList as $item) {
?>
					<option value="<?= $item->getId()?>"<?= $item->getId() == $default ? ' selected="selected"' : null?>><?= $item->getName()?></option>
<?php
	}
?>
				</select>
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_realty_type">Published</label>
			<div class="controls">
<?php
	$default = isset($filter['filter:published'])
		? $filter['filter:published']
		: null;
?>
				<select id="input_realty_type" class="input-block-level" name="filter:published">
					<option value=""></option>
					<option value="yes"<?= $default == 'yes' ? 'selected="selected"' : null?>>Published</option>
					<option value="no"<?= $default == 'no' ? 'selected="selected"' : null?>>Not published</option>
				</select>
			</div>
		</div>
	</div>

</div>

<div class="row-fluid">

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_created_from">Created From</label>
			<div class="controls">
				<input class="input-block-level" type="text" id="input_created_from" name="filter:created_from" value="<?= empty($filter['filter:created_from']) ? null : $filter['']?>" />
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="input_created_to">To</label>
			<div class="controls">
				<input class="input-block-level" type="text" id="input_created_to" name="filter:created_to" value="<?= empty($filter['filter:created_to']) ? null : $filter['filter:created_to']?>" />
			</div>
		</div>
	</div>

</div>

<!--div class="row-fluid">

	<div class="span6">

	</div>

	<div class="span6">

	</div>

</div-->

<div class="row-fluid">

	<div class="span6">
		<a href="<?= $urlHelper->getUrl()?>" class="btn input-block-level">Reset</a>
	</div>

	<div class="span6">
		<button type="submit" class="btn input-block-level btn-primary">Submit</button>
	</div>

</div>

</form>