<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoCity extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'City', 8, true, true, false, null, null),
						'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 128, false, true, false, null, null),
						'latitude' => LightMetaProperty::fill(new LightMetaProperty(), 'latitude', null, 'float', null, 4, false, true, false, null, null),
						'longitude' => LightMetaProperty::fill(new LightMetaProperty(), 'longitude', null, 'float', null, 4, false, true, false, null, null),
						'region' => LightMetaProperty::fill(new LightMetaProperty(), 'region', 'region_id', 'identifier', 'City', null, false, false, false, 1, 3)
					)
				);
		}
	}
?>