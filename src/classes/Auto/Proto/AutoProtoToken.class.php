<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-01 17:37:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoToken extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Token', 8, true, true, false, null, null),
						'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 16, true, true, false, null, null),
						'i18n' => LightMetaProperty::fill(new LightMetaProperty(), 'i18n', 'i18n_id', 'identifierList', 'Token_i18n', null, false, false, false, 2, null)
					)
				);
		}
	}
?>