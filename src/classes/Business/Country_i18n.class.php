<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-10-17 09:54:28                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Country_i18n extends AutoCountry_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return Country_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return Country_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('Country_i18nDAO');
		}
		
		/**
		 * @return ProtoCountry_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoCountry_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>