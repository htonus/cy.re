<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-06-21 14:23:29                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPerson extends IdentifiableObject implements Created
	{
		protected $name = null;
		protected $surname = null;
		protected $email = null;
		protected $phone = null;
		protected $language = null;
		protected $status = null;
		protected $created = null;
		protected $username = null;
		protected $password = null;
		protected $autologin = null;
		protected $groups = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Person
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		public function getSurname()
		{
			return $this->surname;
		}
		
		/**
		 * @return Person
		**/
		public function setSurname($surname)
		{
			$this->surname = $surname;
			
			return $this;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
		
		/**
		 * @return Person
		**/
		public function setEmail($email)
		{
			$this->email = $email;
			
			return $this;
		}
		
		public function getPhone()
		{
			return $this->phone;
		}
		
		/**
		 * @return Person
		**/
		public function setPhone($phone)
		{
			$this->phone = $phone;
			
			return $this;
		}
		
		/**
		 * @return Language
		**/
		public function getLanguage()
		{
			return $this->language;
		}
		
		/**
		 * @return Person
		**/
		public function setLanguage(Language $language = null)
		{
			$this->language = $language;
			
			return $this;
		}
		
		/**
		 * @return Person
		**/
		public function dropLanguage()
		{
			$this->language = null;
			
			return $this;
		}
		
		/**
		 * @return PersonStatus
		**/
		public function getStatus()
		{
			return $this->status;
		}
		
		/**
		 * @return Person
		**/
		public function setStatus(PersonStatus $status)
		{
			$this->status = $status;
			
			return $this;
		}
		
		/**
		 * @return Person
		**/
		public function dropStatus()
		{
			$this->status = null;
			
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
		 * @return Person
		**/
		public function setCreated(Timestamp $created)
		{
			$this->created = $created;
			
			return $this;
		}
		
		/**
		 * @return Person
		**/
		public function dropCreated()
		{
			$this->created = null;
			
			return $this;
		}
		
		public function getUsername()
		{
			return $this->username;
		}
		
		/**
		 * @return Person
		**/
		public function setUsername($username)
		{
			$this->username = $username;
			
			return $this;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		/**
		 * @return Person
		**/
		public function setPassword($password)
		{
			$this->password = $password;
			
			return $this;
		}
		
		public function getAutologin()
		{
			return $this->autologin;
		}
		
		/**
		 * @return Person
		**/
		public function setAutologin($autologin)
		{
			$this->autologin = $autologin;
			
			return $this;
		}
		
		/**
		 * @return PersonGroupsDAO
		**/
		public function getGroups($lazy = false)
		{
			if (!$this->groups || ($this->groups->isLazy() != $lazy)) {
				$this->groups = new PersonGroupsDAO($this, $lazy);
			}
			
			return $this->groups;
		}
		
		/**
		 * @return Person
		**/
		public function fillGroups($collection, $lazy = false)
		{
			$this->groups = new PersonGroupsDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->groups->mergeList($collection);
			
			return $this;
		}
	}
?>