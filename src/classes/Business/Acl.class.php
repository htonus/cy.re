<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class Acl
	{
		private $status		= null;
		private $accessList	= array();
		private $resourceMap = array();
		
		public function __construct(Person $user)
		{
			$this->setUser($user);
		}
		
		public function setUser(Person $user)
		{
			return $this->setup($user);
		}
		
		private function setup(Person $user)
		{
			$this->accessList = array();
			$this->resourceMap = array();
			
			$this->status = $user->getStatus()->getId();
			$groupIds = $user->getGroups(true)->getList();
			
			if (empty($groupIds))
				return $this;
			
			$rules = Criteria::create(GroupAccess::dao())->
				add(
					Expression::in('group', $groupIds)
				)->
				getList();
			
			foreach ($rules as $rule) {
				$this->resourceMap[$rule->getResource()->getName()] =
					$rule->getResource();
				
				$this->accessList[$rule->getResourceId()] = $rule->getAccess()
					| empty($this->accessList[$rule->getResourceId()])
						? 0
						: $this->accessList[$rule->getResourceId()];
			}
			
			return $this;
		}
		
		public function check($resource, $accessId)
		{
			if ($resource instanceof Resource)
				$resourceId = $resource->getId();
			elseif ($resource instanceof Identifiable)
				$resourceId = $this->resourceMap[get_class($resource)];
			else
				$resourceId = $resource;
			
			return $this->checkId($resourceId, $accessId);
		}
		
		public function checkId($resourceId, $accessId)
		{
			$hasAccess = false;
			
			switch ($this->status) {
				case PersonStatus::DELETED:
				case PersonStatus::ROOT:
					$hasAccess = PersonStatus::ROOT == $this->status;
					break;
				
				case PersonStatus::GUEST:
				case PersonStatus::ADMIN:
					if (
						isset($this->accessList[$resourceId])
						&& (
							$accessId == Access::READ
							|| $accessId == Access::LISTS
						)
					)
						$hasAccess = PersonStatus::ADMIN == $this->status;
					
					break;
					
				case PersonStatus::NORMAL:
					$hasAccess = isset($this->accessList[$resourceId])
						&& $this->accessList[$resourceId] & $accessId;
					break;
			}
			
			return $hasAccess;
		}
		
		public function canAdd($resource)
		{
			return $this->check($resource, Access::ADD);
		}
		
		public function canRead($resource)
		{
			return $this->check($resource, Access::READ);
		}
		
		public function canUpdate($resource)
		{
			return $this->check($resource, Access::UPDATE);
		}
		
		public function canDrop($resource)
		{
			return $this->check($resource, Access::DROP);
		}
		
		public function canList($resource)
		{
			return $this->check($resource, Access::LISTS);
		}
		
		public function canPublish($resource)
		{
			return $this->check($resource, Access::PUBLISH);
		}
	}
?>