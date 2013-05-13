					<h4 class="visible-desktop">Search filter:</h4>
					
					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_realtyType">Realty type</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
<?php
	foreach ($realtyTypeList as $item) {
?>
										<option value="<?= $item->getId()?>"><?= ucwords($item->getName())?></option>
<?php
	}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_city">Area, City</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
<?php
	foreach ($cityList as $item) {
?>
										<option value="<?= $item->getId()?>"><?= ucwords($item->getName())?></option>
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
								<label class="control-label" for="input_realtyType">Price from</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="input_city">Price to</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_realtyType" title="Area / bedrooms" style="overflow: hidden; white-space: nowrap;">Area / bedrooms</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_city">Toilets</label>
								<div class="controls">
									<select type="text" class="input-block-level">
										<option>Choose ...</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
									</select>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group">
								<label class="control-label" for="input_city">&nbsp;</label>
								<div class="controls">
									<button class="btn input-block-level">Search</button>
								</div>
							</div>
						</div>
					</div>
