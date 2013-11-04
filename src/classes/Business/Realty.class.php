<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class Realty extends AutoRealty implements Prototyped, DAOConnected
	{
		private $featureList = array();
		private $brief = null;
		
		/**
		 * @return Realty
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return RealtyDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('RealtyDAO');
		}
		
		/**
		 * @return ProtoRealty
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoRealty');
		}

		/**
		 * Feature list indexed by FeatureType ids
		 * @return type
		 */
		public function getFeatureList()
		{
			if (empty($this->featureList)) {
				$list = $this->getFeatures()->
					setCriteria(
						Criteria::create()->
							add(
								Expression::eqId(
									'type.i18n.language',
									GlobalVar::me()->get('language')
								)
							)->
							addOrder(
								OrderBy::create('type.i18n.name')->asc()
							)
					)->
					getList();
				
				$this->featureList = array();
				foreach ($list as $item) {
					$this->featureList[$item->getType()->getId()] = $item;
				}
			}
			
			return $this->featureList;
		}
		
		public function getFeaturesByGroup(FeatureTypeGroup $group)
		{
			$list = $this->getFeatureList();
			$types = FeatureType::dao()->getByGroup($group);
			
			return array_intersect_key($list, $types);
		}

		public function getCode()
		{
			return StringHelper::me()->getCode($this);
		}

		public function getFeatureValue($featureId)
		{
			$list = $this->getFeatureList();

			return empty($list[$featureId])
				? null
				: $list[$featureId]->getValue();
		}
		
		/**
		 * @return RealtyPicturesDAO
		**/
		public function getPictures($lazy = false)
		{
			if (!$this->pictures || ($this->pictures->isLazy() != $lazy)) {
				parent::getPictures($lazy);
				
				$this->pictures->setCriteria(
					Criteria::create()->addOrder('order')
				);
			}
			
			return $this->pictures;
		}

		public function getBrief()
		{
			if ($this->brief === null) {
				$this->brief = TextUtils::cutOnSpace(strip_tags($this->getText()), 512, '...');
				$this->brief = '<p>'.str_replace("\n", '</p><p>', $this->brief).'</p>';
			}

			return $this->brief;
		}
	}
