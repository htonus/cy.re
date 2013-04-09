<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2013-04-09 09:46:22                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoArticle extends i18n implements Pictured, Created, Published
	{
		protected $name = null;
		protected $text = null;
		protected $created = null;
		protected $published = null;
		protected $pictures = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Article
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		public function getText()
		{
			return $this->text;
		}
		
		/**
		 * @return Article
		**/
		public function setText($text)
		{
			$this->text = $text;
			
			return $this;
		}
		
		/**
		 * @return Timestamp
		**/
		public function getCreated()
		{
			return $this->created;
		}
		
		/**
		 * @return Article
		**/
		public function setCreated(Timestamp $created)
		{
			$this->created = $created;
			
			return $this;
		}
		
		/**
		 * @return Article
		**/
		public function dropCreated()
		{
			$this->created = null;
			
			return $this;
		}
		
		/**
		 * @return Timestamp
		**/
		public function getPublished()
		{
			return $this->published;
		}
		
		/**
		 * @return Article
		**/
		public function setPublished(Timestamp $published = null)
		{
			$this->published = $published;
			
			return $this;
		}
		
		/**
		 * @return Article
		**/
		public function dropPublished()
		{
			$this->published = null;
			
			return $this;
		}
		
		/**
		 * @return ArticlePicturesDAO
		**/
		public function getPictures($lazy = false)
		{
			if (!$this->pictures || ($this->pictures->isLazy() != $lazy)) {
				$this->pictures = new ArticlePicturesDAO($this, $lazy);
			}
			
			return $this->pictures;
		}
		
		/**
		 * @return Article
		**/
		public function fillPictures($collection, $lazy = false)
		{
			$this->pictures = new ArticlePicturesDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->pictures->mergeList($collection);
			
			return $this;
		}
	}
?>