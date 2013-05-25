<?php

	class PictureSize extends Enumeration
	{
		const NORMAL		= 1;
		const THUMBNAIL	= 2;
		const CAROUSEL	= 3;
		const BIG		= 4;
		const PREVIEW	= 5;
		const LIST2		= 6;

		protected $names = array(
			self::NORMAL		=> 'normal',
			self::THUMBNAIL	=> 'thmbnail',
			self::CAROUSEL	=> 'carousel',
			self::BIG		=> 'big',
			self::PREVIEW	=> 'preview',
			self::LIST2		=> 'itemList2',
		);

		private $widths = array(
			self::NORMAL		=> 1024,
			self::CAROUSEL	=> 770,
			self::THUMBNAIL	=> 150,
			self::BIG		=> 770,
			self::PREVIEW	=> 170,
			self::LIST2		=> 270,
		);
		
		private $heights = array(
			self::NORMAL		=> 768,
			self::BIG		=> 600,
			self::CAROUSEL	=> 410,
			self::THUMBNAIL	=> 100,
			self::PREVIEW	=> 100,
			self::LIST2		=> 180,
		);
		
		/**
		 * @return PictureSize
		 */
		public static function normal()
		{
			return new self(self::NORMAL);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function thumbnail()
		{
			return new self(self::THUMBNAIL);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function carousel()
		{
			return new self(self::CAROUSEL);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function big()
		{
			return new self(self::BIG);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function preview()
		{
			return new self(self::PREVIEW);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function list2()
		{
			return new self(self::LIST2);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function list3()
		{
			return new self(self::LIST3);
		}
		
		/**
		 * @return PictureSize
		 */
		public static function list4()
		{
			return new self(self::LIST4);
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
			return PATH_WEB_USER.'p/'
				.(
					self::NORMAL != $this->id
						? $this->getWidth().'/'.$this->getHeight().'/'
						: null
				)
				.$picture->getFileName();
		}
		
		public function getImgStyle($css = true)
		{
			return $css
				? 'width: '.$this->getWidth().'px; height: '.$this->getHeight().'px;'
				: 'width="'.$this->getWidth().'" height="'.$this->getHeight().'"';
		}
	}
?>