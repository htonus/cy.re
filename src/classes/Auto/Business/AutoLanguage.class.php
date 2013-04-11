<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoLanguage extends NamedObject
	{
		protected $code = null;
		protected $native = null;
		protected $active = null;
		
		public function getCode()
		{
			return $this->code;
		}
		
		/**
		 * @return Language
		**/
		public function setCode($code)
		{
			$this->code = $code;
			
			return $this;
		}
		
		public function getNative()
		{
			return $this->native;
		}
		
		/**
		 * @return Language
		**/
		public function setNative($native)
		{
			$this->native = $native;
			
			return $this;
		}
		
		public function getActive()
		{
			return $this->active;
		}
		
		public function isActive()
		{
			return $this->active;
		}
		
		/**
		 * @return Language
		**/
		public function setActive($active = false)
		{
			$this->active = ($active === true);
			
			return $this;
		}
	}
?>