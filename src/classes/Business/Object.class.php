<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2013-02-11 12:04:18                     *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Object extends AutoObject implements Prototyped, DAOConnected
	{
		/**
		 * @return Object
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return ObjectDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('ObjectDAO');
		}
		
		/**
		 * @return ProtoObject
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoObject');
		}
		
		// your brilliant stuff goes here
	}
?>