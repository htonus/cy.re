<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoArticlePicture extends ProtoPicture
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'object' => LightMetaProperty::fill(new LightMetaProperty(), 'object', 'object_id', 'identifier', 'Article', null, true, false, false, 1, 3),
						'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'ArticlePicture', 8, true, true, false, null, null)
					)
				);
		}
	}
?>