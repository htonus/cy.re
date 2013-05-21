<?php

	class PictureSize extends Enumeration
	{
		const NORMAL		= 1;
		const THUMBNAIL	= 2;
		const CAROUSEL	= 3;

		protected $names = array(
			self::NORMAL		=> 'normal',
			self::THUMBNAIL	=> 'thmbnail',
			self::CAROUSEL	=> 'carousel',
		);

		private $widths = array(
			self::NORMAL		=> 1024,
			self::CAROUSEL	=> 770,
			self::THUMBNAIL	=> 150,
		);

		private $heights = array(
			self::NORMAL		=> 768,
			self::CAROUSEL	=> 410,
			self::THUMBNAIL	=> 100,
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
			return PATH_WEB_PIX
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