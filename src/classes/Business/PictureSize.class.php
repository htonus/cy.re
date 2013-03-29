<?php

	class PictureSize extends Enumeration
	{
		const NORMAL		= 1;
		const THUMBNAIL	= 2;

		protected $names = array(
			self::NORMAL		=> 'normal',
			self::THUMBNAIL	=> 'thmbnail',
		);

		private $widths = array(
			self::NORMAL		=> 1024,
			self::THUMBNAIL	=> 150,
		);

		private $heights = array(
			self::NORMAL		=> 768,
			self::THUMBNAIL	=> 100,
		);

		public static function normal()
		{
			return new self(self::NORMAL);
		}

		public static function thumbnail()
		{
			return new self(self::THUMBNAIL);
		}

		public function getWidth()
		{
			return $this->widths[$this->id];
		}

		public function getHeight()
		{
			return $this->heights[$this->id];
		}

		public function getUrl(Picture $picture)
		{
			return $picture->getUrl()
				.'?w='.$this->getWidth().'&h='.$this->getHeight();
		}
	}
?>