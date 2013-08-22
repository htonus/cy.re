<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-08-19 11:56:46                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class ArticleCategoryI18nDAO extends OneToManyLinked
	{
		public function __construct(ArticleCategory $articleCategory, $lazy = false)
		{
			parent::__construct(
				$articleCategory,
				ArticleCategory_i18n::dao(),
				$lazy
			);
		}
		
		/**
		 * @return ArticleCategoryI18nDAO
		**/
		public static function create(ArticleCategory $articleCategory, $lazy = false)
		{
			return new self($articleCategory, $lazy);
		}
		
		public function getParentIdField()
		{
			return 'object_id';
		}
	}
?>