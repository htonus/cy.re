<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class GroupAccess extends AutoGroupAccess implements Prototyped, DAOConnected
	{
		/**
		 * @return GroupAccess
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return GroupAccessDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('GroupAccessDAO');
		}
		
		/**
		 * @return ProtoGroupAccess
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoGroupAccess');
		}
		
		// your brilliant stuff goes here
	}
?>