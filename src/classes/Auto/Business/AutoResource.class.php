<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoResource extends IdentifiableObject
	{
		protected $name = null;
		protected $type = null;
		protected $typeId = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Resource
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		/**
		 * @return ResourceType
		**/
		public function getType()
		{
			if (!$this->type && $this->typeId) {
				$this->type = new ResourceType($this->typeId);
			}
			
			return $this->type;
		}
		
		public function getTypeId()
		{
			return $this->type
				? $this->type->getId()
				: $this->typeId;
		}
		
		/**
		 * @return Resource
		**/
		public function setType(ResourceType $type)
		{
			$this->type = $type;
			$this->typeId = $type ? $type->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Resource
		**/
		public function setTypeId($id)
		{
			$this->type = null;
			$this->typeId = $id;
			
			return $this;
		}
		
		/**
		 * @return Resource
		**/
		public function dropType()
		{
			$this->type = null;
			$this->typeId = null;
			
			return $this;
		}
	}
?>