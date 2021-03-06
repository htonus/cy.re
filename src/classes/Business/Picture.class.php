<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	abstract class Picture extends AutoPicture implements Prototyped, DAOConnected
	{
		private $uploadName = null;

		/**
		 * @param string $name
		 * @return Picture
		 */
		public function setUploadName($name)
		{
			$this->uploadName = $name;
			return $this;
		}

		public function getUploadName()
		{
			return $this->uploadName;
		}
		
		public function getFileName()
		{
			return $this->getId().'.'.$this->getType()->getExtension();
		}
		
		public function getUrl()
		{
			return PATH_WEB_PIX.$this->getFileName();
		}

		public function getPath($isCachePath = false)
		{
			return PATH_PIX
				.($isCachePath ? 'cache/' : null)
				.implode(DS, str_split(substr(sprintf('%08d', $this->getId()), 0, -2), 2)).DS
				.(
					$isCachePath
						? null
						: $this->getId().'.'.$this->getType()->getExtension()
				);
		}
		
		public function getTextToken()
		{
			if ($text = $this->getText())
				return "___{$text}___";
			
			return null;
		}
	}
?>
