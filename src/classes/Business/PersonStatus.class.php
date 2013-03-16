<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class PersonStatus extends Enumeration
	{
		const DELETED	= 1;
		const GUEST		= 2;
		const NORMAL		= 3;
		const ADMIN		= 4;
		const ROOT		= 5;

		protected $names = array(
			self::DELETED	=> 'No access',	// no access
			self::GUEST		=> 'Readonly',	// Read-only access to objects allowed by groups
			self::NORMAL		=> 'Normal',	// According to the Groups
			self::ADMIN		=> 'Admin',	// Full access to objects allowed by groups
			self::ROOT		=> 'Full access',	// Full access to evrything
		);
		
		/**
		 * @return PersonStatus
		 */
		public static function normal()
		{
			return new self(self::NORMAL);
		}
	}
?>