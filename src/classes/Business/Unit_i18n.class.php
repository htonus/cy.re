<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-24 17:15:30                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Unit_i18n extends AutoUnit_i18n implements Prototyped, DAOConnected
	{
		/**
		 * @return Unit_i18n
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return Unit_i18nDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('Unit_i18nDAO');
		}
		
		/**
		 * @return ProtoUnit_i18n
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoUnit_i18n');
		}
		
		// your brilliant stuff goes here
	}
?>