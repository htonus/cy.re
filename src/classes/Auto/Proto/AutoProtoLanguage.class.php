<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoLanguage extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Language', 8, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 16, true, true, false, null, null),
				'code' => LightMetaProperty::fill(new LightMetaProperty(), 'code', null, 'string', null, 2, true, true, false, null, null),
				'native' => LightMetaProperty::fill(new LightMetaProperty(), 'native', null, 'string', null, 16, true, true, false, null, null),
				'active' => LightMetaProperty::fill(new LightMetaProperty(), 'active', null, 'boolean', null, null, true, true, false, null, null)
			);
		}
	}
?>