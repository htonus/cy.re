<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-11 11:29:22                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoDictionary extends IdentifiableObject
	{
		protected $token = null;
		protected $name = null;
		protected $value = null;
		protected $lang = null;
		protected $langId = null;
		
		public function getToken()
		{
			return $this->token;
		}
		
		/**
		 * @return Dictionary
		**/
		public function setToken($token)
		{
			$this->token = $token;
			
			return $this;
		}
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Dictionary
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		public function getValue()
		{
			return $this->value;
		}
		
		/**
		 * @return Dictionary
		**/
		public function setValue($value)
		{
			$this->value = $value;
			
			return $this;
		}
		
		/**
		 * @return Language
		**/
		public function getLang()
		{
			if (!$this->lang && $this->langId) {
				$this->lang = Language::dao()->getById($this->langId);
			}
			
			return $this->lang;
		}
		
		public function getLangId()
		{
			return $this->lang
				? $this->lang->getId()
				: $this->langId;
		}
		
		/**
		 * @return Dictionary
		**/
		public function setLang(Language $lang)
		{
			$this->lang = $lang;
			$this->langId = $lang ? $lang->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Dictionary
		**/
		public function setLangId($id)
		{
			$this->lang = null;
			$this->langId = $id;
			
			return $this;
		}
		
		/**
		 * @return Dictionary
		**/
		public function dropLang()
		{
			$this->lang = null;
			$this->langId = null;
			
			return $this;
		}
	}
?>