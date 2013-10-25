<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-10-25 13:39:10                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoArticle extends i18n implements Pictured, Created, Published
	{
		protected $i18n = null;
		protected $created = null;
		protected $published = null;
		protected $category = null;
		protected $categoryId = null;
		protected $promote = false;
		protected $pictures = null;
		protected $type = null;
		protected $sites = null;
		
		/**
		 * @return ArticleI18nDAO
		**/
		public function getI18n($lazy = false)
		{
			if (!$this->i18n || ($this->i18n->isLazy() != $lazy)) {
				$this->i18n = new ArticleI18nDAO($this, $lazy);
			}
			
			return $this->i18n;
		}
		
		/**
		 * @return Article
		**/
		public function fillI18n($collection, $lazy = false)
		{
			$this->i18n = new ArticleI18nDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->i18n->mergeList($collection);
			
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
		 * @return ArticleCategory
		**/
		public function getCategory()
		{
			if (!$this->category && $this->categoryId) {
				$this->category = ArticleCategory::dao()->getById($this->categoryId);
			}
			
			return $this->category;
		}
		
		public function getCategoryId()
		{
			return $this->category
				? $this->category->getId()
				: $this->categoryId;
		}
		
		/**
		 * @return Article
		**/
		public function setCategory(ArticleCategory $category = null)
		{
			$this->category = $category;
			$this->categoryId = $category ? $category->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Article
		**/
		public function setCategoryId($id = null)
		{
			$this->category = null;
			$this->categoryId = $id;
			
			return $this;
		}
		
		/**
		 * @return Article
		**/
		public function dropCategory()
		{
			$this->category = null;
			$this->categoryId = null;
			
			return $this;
		}
		
		public function getPromote()
		{
			return $this->promote;
		}
		
		public function isPromote()
		{
			return $this->promote;
		}
		
		/**
		 * @return Article
		**/
		public function setPromote($promote = null)
		{
			Assert::isTernaryBase($promote);
			
			$this->promote = $promote;
			
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
		
		/**
		 * @return ArticleType
		**/
		public function getType()
		{
			return $this->type;
		}
		
		/**
		 * @return Article
		**/
		public function setType(ArticleType $type)
		{
			$this->type = $type;
			
			return $this;
		}
		
		/**
		 * @return Article
		**/
		public function dropType()
		{
			$this->type = null;
			
			return $this;
		}
		
		/**
		 * @return ArticleSitesDAO
		**/
		public function getSites($lazy = false)
		{
			if (!$this->sites || ($this->sites->isLazy() != $lazy)) {
				$this->sites = new ArticleSitesDAO($this, $lazy);
			}
			
			return $this->sites;
		}
		
		/**
		 * @return Article
		**/
		public function fillSites($collection, $lazy = false)
		{
			$this->sites = new ArticleSitesDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->sites->mergeList($collection);
			
			return $this;
		}
	}
?>