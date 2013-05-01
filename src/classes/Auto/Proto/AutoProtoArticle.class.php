<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-01 17:37:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoArticle extends Protoi18n
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'Article', 8, true, true, false, null, null),
						'i18n' => LightMetaProperty::fill(new LightMetaProperty(), 'i18n', 'i18n_id', 'identifierList', 'Article_i18n', null, false, false, false, 2, null),
						'created' => LightMetaProperty::fill(new LightMetaProperty(), 'created', null, 'timestamp', 'Timestamp', null, true, true, false, null, null),
						'published' => LightMetaProperty::fill(new LightMetaProperty(), 'published', null, 'timestamp', 'Timestamp', null, false, true, false, null, null),
						'pictures' => LightMetaProperty::fill(new LightMetaProperty(), 'pictures', 'pictures_id', 'identifierList', 'ArticlePicture', null, false, false, false, 2, null)
					)
				);
		}
	}
?>