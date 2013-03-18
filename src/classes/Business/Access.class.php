<?php

	class Access extends StaticFactory
	{
		const ADD		= 0x01;
		const UPDATE	= 0x02;
		const READ		= 0x04;
		const DROP		= 0x08;
		const LISTS		= 0x10;
		const PUBLISH	= 0x20;
		
//		const ADD	= 0x01;
//		const EDIT	= 0x02;
//		const SAVE	= 0x04;
//		const DROP	= 0x08;
//		const INDEX	= 0x10;
//		const PUBLISH = 0x20;

		private static $names = array(
			self::ADD		=> 'Add',
			self::UPDATE	=> 'Update',
			self::READ		=> 'Read',
			self::DROP		=> 'Drop',
			self::LISTS		=> 'Lists',
			self::PUBLISH	=> 'Publish',
		);
		
		public static function getNames()
		{
			return self::$names;
		}
	}
?>