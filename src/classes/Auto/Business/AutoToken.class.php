<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 11:25:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoToken extends i18n
	{
		protected $name = null;
		protected $i18n = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Token
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		/**
		 * @return TokenI18nDAO
		**/
		public function getI18n($lazy = false)
		{
			if (!$this->i18n || ($this->i18n->isLazy() != $lazy)) {
				$this->i18n = new TokenI18nDAO($this, $lazy);
			}
			
			return $this->i18n;
		}
		
		/**
		 * @return Token
		**/
		public function fillI18n($collection, $lazy = false)
		{
			$this->i18n = new TokenI18nDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->i18n->mergeList($collection);
			
			return $this;
		}
	}
?>