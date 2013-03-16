<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Group extends AutoGroup implements Prototyped, DAOConnected
	{
		/**
		 * @return Group
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return GroupDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('GroupDAO');
		}
		
		/**
		 * @return ProtoGroup
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoGroup');
		}
		
		public function getRuleList()
		{
			$list = $this->getRules()->getList();
			
			$out = array();
			
			foreach ($list as $item) {
				$out[$item->getResourceId()] = $item;
			}
			
			return $out;
		}
	}
?>