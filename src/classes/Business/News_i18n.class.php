<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2013-04-09 09:46:22                     *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class News_i18n extends AutoNews_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return News_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return News_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('News_i18nDAO');
		}
		
		/**
		 * @return ProtoNews_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoNews_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>