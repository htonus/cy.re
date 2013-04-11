<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 12:04:28                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoRealty extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Realty', 8, true, true, false, null, null),
						'i18n' => LightMetaProperty::fill(new LightMetaProperty(), 'i18n', 'i18n_id', 'identifierList', 'Realty_i18n', null, false, false, false, 2, null),
						'latitude' => LightMetaProperty::fill(new LightMetaProperty(), 'latitude', null, 'float', null, 4, false, true, false, null, null),
						'longitude' => LightMetaProperty::fill(new LightMetaProperty(), 'longitude', null, 'float', null, 4, false, true, false, null, null),
						'realtyType' => LightMetaProperty::fill(new LightMetaProperty(), 'realtyType', 'type_id', 'identifier', 'RealtyType', null, true, false, false, 1, 3),
						'offerType' => LightMetaProperty::fill(new LightMetaProperty(), 'offerType', 'offer_id', 'enumeration', 'OfferType', null, true, false, false, 1, 3),
						'city' => LightMetaProperty::fill(new LightMetaProperty(), 'city', 'city_id', 'identifier', 'City', null, true, false, false, 1, 3),
						'preview' => LightMetaProperty::fill(new LightMetaProperty(), 'preview', 'preview_id', 'identifier', 'RealtyPicture', null, false, false, false, 1, 3),
						'created' => LightMetaProperty::fill(new LightMetaProperty(), 'created', null, 'timestamp', 'Timestamp', null, true, true, false, null, null),
						'published' => LightMetaProperty::fill(new LightMetaProperty(), 'published', null, 'timestamp', 'Timestamp', null, false, true, false, null, null),
						'pictures' => LightMetaProperty::fill(new LightMetaProperty(), 'pictures', 'pictures_id', 'identifierList', 'RealtyPicture', null, false, false, false, 2, null),
						'features' => LightMetaProperty::fill(new LightMetaProperty(), 'features', 'features_id', 'identifierList', 'Feature', null, false, false, false, 2, null)
					)
				);
		}
	}
?>