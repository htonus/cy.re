<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-11 11:29:22                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class Dictionary extends AutoDictionary implements Prototyped
	{
		/**
		 * @return Dictionary
		**/
		public static function create()
		{
			return new self;
		}
		
		
		/**
		 * @return ProtoDictionary
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoDictionary');
		}
		
		// your brilliant stuff goes here
	}
?>