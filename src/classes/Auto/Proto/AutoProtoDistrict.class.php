<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-10 08:54:01                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoDistrict extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'District', 8, true, true, false, null, null),
						'i18n' => LightMetaProperty::fill(new LightMetaProperty(), 'i18n', 'i18n_id', 'identifierList', 'District_i18n', null, false, false, false, 2, null),
						'latitude' => LightMetaProperty::fill(new LightMetaProperty(), 'latitude', null, 'float', null, 4, false, true, false, null, null),
						'longitude' => LightMetaProperty::fill(new LightMetaProperty(), 'longitude', null, 'float', null, 4, false, true, false, null, null),
						'city' => LightMetaProperty::fill(new LightMetaProperty(), 'city', 'city_id', 'identifier', 'City', null, true, false, false, 1, 3)
					)
				);
		}
	}
?>