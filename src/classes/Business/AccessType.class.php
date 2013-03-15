<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class AccessType extends Enumeration
	{
		const ADD	= 1;
		const EDIT	= 2;
		const SAVE	= 3;
		const DROP	= 4;
		const INDEX	= 5;
		const PUBLISH = 6;

		protected $names = array(
			self::ADD	=> 'Add',
			self::EDIT	=> 'Edit',
			self::SAVE	=> 'Save',
			self::DROP	=> 'Drop',
			self::INDEX	=> 'Index',
			self::PUBLISH	=> 'Publish',
		);

		/**
		 * @return AccessType
		 */
		public static function add()
		{
			return new self(self::ADD);
		}
	}
?>