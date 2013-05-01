<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:34:01                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class FeatureTypeI18nDAO extends OneToManyLinked
	{
		public function __construct(FeatureType $featureType, $lazy = false)
		{
			parent::__construct(
				$featureType,
				FeatureType_i18n::dao(),
				$lazy
			);
		}
		
		/**
		 * @return FeatureTypeI18nDAO
		**/
		public static function create(FeatureType $featureType, $lazy = false)
		{
			return new self($featureType, $lazy);
		}
		
		public function getParentIdField()
		{
			return 'object_id';
		}
	}
?>