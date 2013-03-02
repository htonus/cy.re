<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Realty extends AutoRealty implements Prototyped, DAOConnected
	{
		/**
		 * @return Realty
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return RealtyDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('RealtyDAO');
		}
		
		/**
		 * @return ProtoRealty
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoRealty');
		}
		
		// your brilliant stuff goes here
	}
?>