<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-07 20:16:16                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoToken_i18n extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Token_i18n', 8, true, true, false, null, null),
				'object' => LightMetaProperty::fill(new LightMetaProperty(), 'object', 'object_id', 'identifier', 'Token', null, true, false, false, 1, 3),
				'language' => LightMetaProperty::fill(new LightMetaProperty(), 'language', 'language_id', 'integerIdentifier', 'Language', null, true, false, false, 1, 3),
				'value' => LightMetaProperty::fill(new LightMetaProperty(), 'value', null, 'string', null, 128, false, true, false, null, null)
			);
		}
	}
?>