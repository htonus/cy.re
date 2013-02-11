<?php

	final class UrlMapper extends Singleton
	{
		private $lang = 'en';

		public static function me()
		{
			return parent::getInstance(__CLASS__);
		}

		public function setLanguage($lang)
		{
			$this->lang = $lang;
			return $this;
		}
	}