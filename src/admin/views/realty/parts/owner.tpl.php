<?php
/**
 * $Id$
 */
	
?>
	<h4>
		Owner
		<button type="button" class="btn btn-success" id="browseOwner">Browse</button>
		or
		<button type="button" class="btn btn-danger" id="addNewOwner">Add new</button>
	</h4>

	<div class="row-fluid" id="ownerBlock">
<?php
	$owner = $form->getValue('owner') ? $form->getValue('owner') : $defaultOwner;
	$disabled = $owner ? 'disabled="disabled"' : null;
?>

		<input type="hidden" name="owner" value="<?= $form->getValue('owner') ? $form->getValue('owner')->getId() : null; ?>" />

		<div class="control-group">
			<label class="control-label" for="input_name">Name</label>
			<div class="controls">
				<input type="text" id="input_name" placeholder="Name" name="_owner[name]" value="<?= $owner ? $owner->getName() : null; ?>" <?= $disabled?> />
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_surname">Surname</label>
			<div class="controls">
				<input type="text" id="input_surname" placeholder="Surname" name="_owner[surname]" value="<?= $owner ? $owner->getSurname() : null; ?>" <?= $disabled?> />
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_email">Email</label>
			<div class="controls">
				<input type="text" id="input_email" placeholder="eMail" name="_owner[email]" value="<?= $owner ? $owner->getEmail() : null; ?>" <?= $disabled?> />
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input_phone">Telephone</label>
			<div class="controls">
				<input type="text" id="input_phone" placeholder="Telephone" name="_owner[phone]" value="<?= $owner ? $owner->getPhone() : null; ?>" <?= $disabled?> />
			</div>
		</div>

<?php
	
?>
	</div>

<script type="text/javascript">
jq(document).ready(function(){
	jq('#browseOwner').click(function(){
		jq('#sharedModal').modal('show');
	});
	jq('#addNewOwner').click(function(){
		jq('#ownerBlock INPUT')
			.removeAttr('disabled')
			.val('');
	});
});

function browseOwners(form)
{
	jq('#sharedModal #searchResult TABLE').html('');
	
	jq.getJSON(
		'/index.php?area=person&action=browse',
		{
			field: form.field.value,
			value: form.sample.value
		},
		function(data) {
			if (data.status == 1) {
				for (key in data.list) {
					jq('#sharedModal #searchResult TABLE')
						.append(
							'<tr id="searchResult_' + data.list[key].owner + '">'
							+ '<td class="o_name">' + data.list[key].name + '</td>'
							+ '<td class="o_surname">' + data.list[key].surname + '</td>'
							+ '<td class="o_email">' + (data.list[key].email ? data.list[key].email : ' - ' ) + '</td>'
							+ '<td class="o_phone">' + (data.list[key].phone ? data.list[key].phone : ' - ') + '</td>'
							+ '<td><input type="button" value="choose" class="btn btn-small" /></td>'
							+ '</tr>'
						);
				}
				jq('#sharedModal #searchResult TABLE .btn').click(function(){
					var tr = jq(this).parent().parent();
					console.log(tr);
					jq('#ownerBlock INPUT[name=owner]').val('' + tr.attr('id').match(/\d+/));
					jq('#ownerBlock INPUT[name="_owner[name]"]').val(jq('.o_name', tr).text());
					jq('#ownerBlock INPUT[name="_owner[surname]"]').val(jq('.o_surname', tr).text());
					jq('#ownerBlock INPUT[name="_owner[email]"]').val(jq('.o_email', tr).text());
					jq('#ownerBlock INPUT[name="_owner[phone]"]').val(jq('.o_phone', tr).text());
					jq('#sharedModal').modal('hide');
				});
			}
			
			jq('#ownerBlock INPUT')
				.attr('disabled', 'disabled');
		}
	);
}
</script>


<div class="modal hide fade" id="sharedModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modal header</h3>
	</div>
	<div class="modal-body">
		<form class="form-inline">
			Search by &nbsp;
			<select name="field" class="input-small">
				<option value="name">Name</option>
				<option value="surname">Surname</option>
				<option value="email">eMail</option>
				<option value="phone">Telephone</option>
				<option value="username">Username</option>
			</select>
			<input type="text" name="sample" value="" class="input-small" />
			<input type="button" class="btn btn-primary" value="Browse" onclick="browseOwners(this.form)" />
		</form>
		<br/>.
		<div id="searchResult" style="height: 300px" style="overflow-y: scroll;">
			<table width="100%"></table>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>