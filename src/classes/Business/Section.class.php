<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-20 11:48:13                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Section extends Enumeration
	{
		const BUY		= 1;
		const RENT		= 2;
		const SELL		= 3;
		const LEND		= 4;
		const INFO		= 5;
		const PROJECT	= 6;
		const ABOUT	= 7;

		protected $names = array(
			self::BUY		=> '_S__buy___',
			self::RENT		=> '_S__rent___',
			self::SELL		=> '_S__sell___',
			self::LEND		=> '_S__lend___',
			self::INFO		=> '_S__info___',
			self::PROJECT	=> '_S__project___',
			self::ABOUT		=> '_S__about___',
		);

		protected $slugs = array(
			self::BUY		=> 'buy',
			self::RENT		=> 'rent',
			self::SELL		=> 'sell',
			self::LEND		=> 'lend',
			self::INFO		=> 'information',
			self::PROJECT	=> 'project',
			self::ABOUT		=> 'about',
		);

		
		public static function create($id)
		{
			return new self($id);
		}
		
		/**
		 * @return Section
		 */
		public static function buy()
		{
			return new self(self::BUY);
		}
		
		/**
		 * @return Section
		 */
		public static function rent()
		{
			return new self(self::RENT);
		}
		
		/**
		 * @return Section
		 */
		public static function info()
		{
			return new self(self::INFO);
		}
		
		/**
		 * @return Section
		 */
		public static function project()
		{
			return new self(self::PROJECT);
		}
		
		/**
		 * @return Section
		 */
		public static function about()
		{
			return new self(self::ABOUT);
		}

		public function getSlug()
		{
			return $this->slugs[$this->id];
		}
	}
