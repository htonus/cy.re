<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-09-10 08:12:07                    *
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
						'prefix' => LightMetaProperty::fill(new LightMetaProperty(), 'prefix', null, 'string', null, 2, false, true, false, null, null),
						'areaRange' => LightMetaProperty::fill(new LightMetaProperty(), 'areaRange', 'area_range', 'string', null, 256, false, true, false, null, null),
						'i18n' => LightMetaProperty::fill(new LightMetaProperty(), 'i18n', 'i18n_id', 'identifierList', 'RealtyType_i18n', null, false, false, false, 2, null)
					)
				);
		}
	}
?>