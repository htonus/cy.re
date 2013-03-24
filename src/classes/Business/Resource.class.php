<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Resource extends AutoResource implements Prototyped, DAOConnected
	{
		/**
		 * @return Resource
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return ResourceDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('ResourceDAO');
		}
		
		/**
		 * @return ProtoResource
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoResource');
		}
		
		// your brilliant stuff goes here
	}
?>