<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Person extends AutoPerson implements Prototyped, DAOConnected
	{
		const COOKIE_NAME = 'autoLogin';
		
		/**
		 * @return Person
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return PersonDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('PersonDAO');
		}
		
		/**
		 * @return ProtoPerson
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoPerson');
		}
		
		private $acl = null;

		/**
		 * Get Acl object to check access to the resources
		 * @return Acl $object
		 */
		public function getAcl()
		{
			if (empty($this->acl)) {
				$this->acl = new Acl($this);
			}
			
			return $this->acl;
		}
	}
?>