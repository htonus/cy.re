<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoRealtyType_i18n extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'RealtyType_i18n', 8, true, true, false, null, null),
				'object' => LightMetaProperty::fill(new LightMetaProperty(), 'object', 'object_id', 'identifier', 'RealtyType', null, true, false, false, 1, 3),
				'language' => LightMetaProperty::fill(new LightMetaProperty(), 'language', 'language_id', 'integerIdentifier', 'Language', null, true, false, false, 1, 3),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 16, true, true, false, null, null)
			);
		}
	}
?>