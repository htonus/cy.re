<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-08-19 12:13:26                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class ArticleCategory_i18n extends AutoArticleCategory_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return ArticleCategory_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return ArticleCategory_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('ArticleCategory_i18nDAO');
		}
		
		/**
		 * @return ProtoArticleCategory_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoArticleCategory_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>