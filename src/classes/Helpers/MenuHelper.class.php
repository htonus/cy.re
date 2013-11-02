<?php

	final class MenuHelper extends StaticFactory
	{
		public static function getMenuList()
		{
			return array(
				Section::buy(),
				Section::rent(),
				Section::project(),
				Section::info(),
				Section::about()
			);
		}
		
		public static function hasSubMenu(Section $section)
		{
			return in_array(
				$section->getId(),
				array(
					Section::RENT,
					Section::INFO,
				)
			);
		}
	}