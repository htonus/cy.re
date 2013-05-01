<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-01 17:37:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoUnit_i18n extends IdentifiableObject
	{
		protected $object = null;
		protected $objectId = null;
		protected $language = null;
		protected $languageId = null;
		protected $name = null;
		
		/**
		 * @return Unit
		**/
		public function getObject()
		{
			if (!$this->object && $this->objectId) {
				$this->object = Unit::dao()->getById($this->objectId);
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
		 * @return Unit_i18n
		**/
		public function setObject(Unit $object)
		{
			$this->object = $object;
			$this->objectId = $object ? $object->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function setObjectId($id)
		{
			$this->object = null;
			$this->objectId = $id;
			
			return $this;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function dropObject()
		{
			$this->object = null;
			$this->objectId = null;
			
			return $this;
		}
		
		/**
		 * @return Language
		**/
		public function getLanguage()
		{
			if (!$this->language && $this->languageId) {
				$this->language = Language::dao()->getById($this->languageId);
			}
			
			return $this->language;
		}
		
		public function getLanguageId()
		{
			return $this->language
				? $this->language->getId()
				: $this->languageId;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function setLanguage(Language $language)
		{
			$this->language = $language;
			$this->languageId = $language ? $language->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function setLanguageId($id)
		{
			$this->language = null;
			$this->languageId = $id;
			
			return $this;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function dropLanguage()
		{
			$this->language = null;
			$this->languageId = null;
			
			return $this;
		}
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Unit_i18n
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
	}
?>