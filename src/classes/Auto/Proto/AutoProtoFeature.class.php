<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoFeature extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Feature', 8, true, true, false, null, null),
				'type' => LightMetaProperty::fill(new LightMetaProperty(), 'type', 'type_id', 'identifier', 'FeatureType', null, true, false, false, 1, 3),
				'value' => LightMetaProperty::fill(new LightMetaProperty(), 'value', null, 'integer', null, 8, false, true, false, null, null),
				'realty' => LightMetaProperty::fill(new LightMetaProperty(), 'realty', 'realty_id', 'identifier', 'Realty', null, true, false, false, 1, 3)
			);
		}
	}
?>