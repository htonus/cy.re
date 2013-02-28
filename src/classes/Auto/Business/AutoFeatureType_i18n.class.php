<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-28 23:09:05                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoFeatureType_i18n extends IdentifiableObject
	{
		protected $object = null;
		protected $objectId = null;
		protected $language = null;
		protected $languageId = null;
		protected $name = null;
		
		/**
		 * @return FeatureType
		**/
		public function getObject()
		{
			if (!$this->object && $this->objectId) {
				$this->object = FeatureType::dao()->getById($this->objectId);
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
		 * @return FeatureType_i18n
		**/
		public function setObject(FeatureType $object)
		{
			$this->object = $object;
			$this->objectId = $object ? $object->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return FeatureType_i18n
		**/
		public function setObjectId($id)
		{
			$this->object = null;
			$this->objectId = $id;
			
			return $this;
		}
		
		/**
		 * @return FeatureType_i18n
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
		 * @return FeatureType_i18n
		**/
		public function setLanguage(Language $language)
		{
			$this->language = $language;
			$this->languageId = $language ? $language->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return FeatureType_i18n
		**/
		public function setLanguageId($id)
		{
			$this->language = null;
			$this->languageId = $id;
			
			return $this;
		}
		
		/**
		 * @return FeatureType_i18n
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
		 * @return FeatureType_i18n
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
	}
?>