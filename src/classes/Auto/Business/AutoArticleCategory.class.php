<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-08-27 19:52:22                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoArticleCategory extends i18n implements Created, Published
	{
		protected $i18n = null;
		protected $created = null;
		protected $published = null;
		protected $parent = null;
		protected $parentId = null;
		protected $slug = null;
		protected $left = 0;
		protected $right = 0;
		
		/**
		 * @return ArticleCategoryI18nDAO
		**/
		public function getI18n($lazy = false)
		{
			if (!$this->i18n || ($this->i18n->isLazy() != $lazy)) {
				$this->i18n = new ArticleCategoryI18nDAO($this, $lazy);
			}
			
			return $this->i18n;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function fillI18n($collection, $lazy = false)
		{
			$this->i18n = new ArticleCategoryI18nDAO($this, $lazy);
			
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
		 * @return ArticleCategory
		**/
		public function setCreated(Timestamp $created)
		{
			$this->created = $created;
			
			return $this;
		}
		
		/**
		 * @return ArticleCategory
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
		 * @return ArticleCategory
		**/
		public function setPublished(Timestamp $published = null)
		{
			$this->published = $published;
			
			return $this;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function dropPublished()
		{
			$this->published = null;
			
			return $this;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function getParent()
		{
			if (!$this->parent && $this->parentId) {
				$this->parent = ArticleCategory::dao()->getById($this->parentId);
			}
			
			return $this->parent;
		}
		
		public function getParentId()
		{
			return $this->parent
				? $this->parent->getId()
				: $this->parentId;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function setParent(ArticleCategory $parent = null)
		{
			$this->parent = $parent;
			$this->parentId = $parent ? $parent->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function setParentId($id = null)
		{
			$this->parent = null;
			$this->parentId = $id;
			
			return $this;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function dropParent()
		{
			$this->parent = null;
			$this->parentId = null;
			
			return $this;
		}
		
		public function getSlug()
		{
			return $this->slug;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function setSlug($slug)
		{
			$this->slug = $slug;
			
			return $this;
		}
		
		public function getLeft()
		{
			return $this->left;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function setLeft($left)
		{
			$this->left = $left;
			
			return $this;
		}
		
		public function getRight()
		{
			return $this->right;
		}
		
		/**
		 * @return ArticleCategory
		**/
		public function setRight($right)
		{
			$this->right = $right;
			
			return $this;
		}
	}
?>