<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-08-19 12:31:48                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoArticleCategory_i18n extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'ArticleCategory_i18n', 8, true, true, false, null, null),
				'object' => LightMetaProperty::fill(new LightMetaProperty(), 'object', 'object_id', 'identifier', 'ArticleCategory', null, true, false, false, 1, 3),
				'language' => LightMetaProperty::fill(new LightMetaProperty(), 'language', 'language_id', 'integerIdentifier', 'Language', null, true, false, false, 1, 3),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 64, false, true, false, null, null),
				'text' => LightMetaProperty::fill(new LightMetaProperty(), 'text', null, 'string', null, 256, false, true, false, null, null)
			);
		}
	}
?>