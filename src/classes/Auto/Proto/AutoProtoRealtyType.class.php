<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-05 14:51:20                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoRealtyType extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'RealtyType', 8, true, true, false, null, null),
						'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 16, false, true, false, null, null)
					)
				);
		}
	}
?>