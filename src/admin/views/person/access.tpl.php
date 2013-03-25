<?php
/*
 * $Id$
 */
	
	$class = get_class($subject);
?>

<h1>Setup Access for <?=$subject->getUsername()?></h1>

<br/>

<form name="editForm" id="editForm" action="/index.php" method="post" class="form-horizontal">
<input type="hidden" name="area" value="person" />
<input type="hidden" name="action" value="access" />
<input type="hidden" name="id" value="<?=$subject->getId()?>" />


<script type="text/javascript">
var accessTypeList = [<?=implode(', ', array_keys($accessPlainList))?>];
var accessList = {
<?php
	foreach ($groupList as $group) {
		echo "\t".(empty($first) ? null : ',')."'{$group->getId()}': {\n";
		$first = 1;
		$comma = false;
		
		foreach ($group->getRules()->getList() as $rule) {
			echo "\t".($comma ? ",\t" : "\t")."'{$rule->getResourceId()}': {$rule->getAccess()}\n";
			$comma = true;
		}
		
		echo "\t}\n";
	}
?>
};

function update_access()
{
	jq('#accessGrid :checkbox').removeAttr('checked');
	
	jq('#input_group OPTION').each(function(i, groupId){
		jq.each(accessList[jq(groupId).val()], function(resourceId, access){
			jq.each(accessTypeList, function(i, accessType){
				if (access & accessType)
					jq('#rule_' + resourceId + '_' + accessType).attr('checked', 'checked');
			});
		});
	});
}

jq(document).ready(function(){
	jq('#editForm').submit(function(){
		jq('#input_group OPTION').attr('selected', "selected");
	});
	
	jq('#addGroup').click(function(){
		var group = jq('#input_allowed_groups :selected');
		jq(group.clone()).appendTo(jq('#input_group'));
		group.remove();
		update_access();
	});
	
	jq('#delGroup').click(function(){
		jq('#input_group :selected').each(function(){
			jq(this).clone().appendTo(jq('#input_allowed_groups'));
			jq(this).remove();
		});
		update_access();
	});
	
	update_access();
});
</script>

<div class="control-group input-append">
	<label class="control-label" for="input_allowed_groups">Allowed Groups</label>
	<div class="controls">
		<select name="groups" id="input_allowed_groups" multiselect>
<?php
	$userGroupIds = $subject->getGroups(true)->getList();
	
	foreach ($groupList as $item) {
		if (in_array($item->getId(), $userGroupIds))
			continue;
?>
			<option value="<?=$item->getId()?>"><?=$item->getName()?></option>
<?php
	}
?>
		</select>
		<button class="btn" type="button" id="addGroup">Assign to user</button>
    </div>
</div>


<div class="control-group input-append">
	<label class="control-label" for="input_group">Participate Groups</label>
	<div class="controls">
		<select name="group[]" id="input_group" multiple size="3">
<?php
	foreach ($subject->getGroups()->getList() as $item) {
?>
			<option value="<?=$item->getId()?>"><?=$item->getName()?></option>
<?php
	}
?>
		</select>
		<button class="btn" type="button" name="submit" id="delGroup">Remove selected</button>
	</div>
</div>



<table class="table table-striped">
<thead>
	<tr>
		<th>Resource \ Access</th>
<?php
	foreach ($accessPlainList as $id => $name) {
?>
		<th><?=$name?></th>
<?php
	}
?>
	</tr>
</thead>

<tbody id="accessGrid">
<?php
	$acl = $subject->getAcl();
	
	foreach ($resourceList as $resource) {
?>
	<tr>
		<td><?=$resource->getName()?></td>
<?php
		foreach ($accessPlainList as $accessId => $accessName) {
			$checked = $acl->check($resource, $accessId)
				? 'checked="checked"'
				: null;
?>
		<td><input type="checkbox" disabled id="rule_<?=$resource->getId()?>_<?=$accessId?>" name="rule[<?=$resource->getId()?>][]" value="<?=$accessId?>" <?=$checked?> /></td>
<?php
		}
?>
	</tr>
<?php
	}
?>
</tbody>
</table>

<div class="control-group">
	<div class="controls">
		<button class="btn btn-primary" name="submit" type="submit">Submit</button>
		<button class="btn" type="button" onclick="document.location.href='/index.php?area=person'">Cancel</button>
    </div>
</div>


</form>
