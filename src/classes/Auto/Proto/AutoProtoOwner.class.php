<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-11 11:29:22                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoOwner extends ProtoPerson
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Owner', 8, true, true, false, null, null),
						'proved' => LightMetaProperty::fill(new LightMetaProperty(), 'proved', null, 'boolean', null, null, true, true, false, null, null),
						'code' => LightMetaProperty::fill(new LightMetaProperty(), 'code', null, 'string', null, 32, false, true, false, null, null),
						'autoLogin' => LightMetaProperty::fill(new LightMetaProperty(), 'autoLogin', 'auto_login', 'string', null, 32, false, true, false, null, null)
					)
				);
		}
	}
?>