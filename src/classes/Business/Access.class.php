<?php

	class Access extends StaticFactory
	{
		const ADD	= 0x01;
		const EDIT	= 0x02;
		const SAVE	= 0x04;
		const DROP	= 0x08;
		const INDEX	= 0x10;
		const PUBLISH = 0x20;

		private static $names = array(
			self::ADD	=> 'Add',
			self::EDIT	=> 'Edit',
			self::SAVE	=> 'Save',
			self::DROP	=> 'Drop',
			self::INDEX	=> 'Index',
			self::PUBLISH	=> 'Publish',
		);
		
		public static function getNames()
		{
			return self::$names;
		}
	}
?>