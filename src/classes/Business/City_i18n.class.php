<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class City_i18n extends AutoCity_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return City_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return City_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('City_i18nDAO');
		}
		
		/**
		 * @return ProtoCity_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoCity_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>