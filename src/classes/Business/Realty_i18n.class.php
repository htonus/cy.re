<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Realty_i18n extends AutoRealty_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return Realty_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return Realty_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('Realty_i18nDAO');
		}
		
		/**
		 * @return ProtoRealty_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoRealty_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>