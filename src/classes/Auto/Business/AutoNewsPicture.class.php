<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-01 17:37:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoNewsPicture extends Picture
	{
		protected $object = null;
		protected $objectId = null;
		
		/**
		 * @return News
		**/
		public function getObject()
		{
			if (!$this->object && $this->objectId) {
				$this->object = News::dao()->getById($this->objectId);
			}
			
			return $this->object;
		}
		
		public function getObjectId()
		{
			return $this->object
				? $this->object->getId()
				: $this->objectId;
		}
		
		/**
		 * @return NewsPicture
		**/
		public function setObject(News $object)
		{
			$this->object = $object;
			$this->objectId = $object ? $object->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return NewsPicture
		**/
		public function setObjectId($id)
		{
			$this->object = null;
			$this->objectId = $id;
			
			return $this;
		}
		
		/**
		 * @return NewsPicture
		**/
		public function dropObject()
		{
			$this->object = null;
			$this->objectId = null;
			
			return $this;
		}
	}
?>