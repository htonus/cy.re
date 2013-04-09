<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2013-04-09 14:30:10                     *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoRealty extends i18n implements Pictured, Created, Published
	{
		protected $name = null;
		protected $text = null;
		protected $latitude = null;
		protected $longitude = null;
		protected $realtyType = null;
		protected $realtyTypeId = null;
		protected $offerType = null;
		protected $offerTypeId = null;
		protected $city = null;
		protected $cityId = null;
		protected $created = null;
		protected $published = null;
		protected $pictures = null;
		protected $features = null;
		
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * @return Realty
		**/
		public function setName($name)
		{
			$this->name = $name;
			
			return $this;
		}
		
		public function getText()
		{
			return $this->text;
		}
		
		/**
		 * @return Realty
		**/
		public function setText($text)
		{
			$this->text = $text;
			
			return $this;
		}
		
		public function getLatitude()
		{
			return $this->latitude;
		}
		
		/**
		 * @return Realty
		**/
		public function setLatitude($latitude)
		{
			$this->latitude = $latitude;
			
			return $this;
		}
		
		public function getLongitude()
		{
			return $this->longitude;
		}
		
		/**
		 * @return Realty
		**/
		public function setLongitude($longitude)
		{
			$this->longitude = $longitude;
			
			return $this;
		}
		
		/**
		 * @return RealtyType
		**/
		public function getRealtyType()
		{
			if (!$this->realtyType && $this->realtyTypeId) {
				$this->realtyType = RealtyType::dao()->getById($this->realtyTypeId);
			}
			
			return $this->realtyType;
		}
		
		public function getRealtyTypeId()
		{
			return $this->realtyType
				? $this->realtyType->getId()
				: $this->realtyTypeId;
		}
		
		/**
		 * @return Realty
		**/
		public function setRealtyType(RealtyType $realtyType)
		{
			$this->realtyType = $realtyType;
			$this->realtyTypeId = $realtyType ? $realtyType->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function setRealtyTypeId($id)
		{
			$this->realtyType = null;
			$this->realtyTypeId = $id;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function dropRealtyType()
		{
			$this->realtyType = null;
			$this->realtyTypeId = null;
			
			return $this;
		}
		
		/**
		 * @return OfferType
		**/
		public function getOfferType()
		{
			if (!$this->offerType && $this->offerTypeId) {
				$this->offerType = new OfferType($this->offerTypeId);
			}
			
			return $this->offerType;
		}
		
		public function getOfferTypeId()
		{
			return $this->offerType
				? $this->offerType->getId()
				: $this->offerTypeId;
		}
		
		/**
		 * @return Realty
		**/
		public function setOfferType(OfferType $offerType)
		{
			$this->offerType = $offerType;
			$this->offerTypeId = $offerType ? $offerType->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function setOfferTypeId($id)
		{
			$this->offerType = null;
			$this->offerTypeId = $id;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function dropOfferType()
		{
			$this->offerType = null;
			$this->offerTypeId = null;
			
			return $this;
		}
		
		/**
		 * @return City
		**/
		public function getCity()
		{
			if (!$this->city && $this->cityId) {
				$this->city = City::dao()->getById($this->cityId);
			}
			
			return $this->city;
		}
		
		public function getCityId()
		{
			return $this->city
				? $this->city->getId()
				: $this->cityId;
		}
		
		/**
		 * @return Realty
		**/
		public function setCity(City $city)
		{
			$this->city = $city;
			$this->cityId = $city ? $city->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function setCityId($id)
		{
			$this->city = null;
			$this->cityId = $id;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function dropCity()
		{
			$this->city = null;
			$this->cityId = null;
			
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
		 * @return Realty
		**/
		public function setCreated(Timestamp $created)
		{
			$this->created = $created;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function dropCreated()
		{
			$this->created = null;
			
			return $this;
		}
		
		/**
		 * @return Timestamp
		**/
		public function getPublished()
		{
			return $this->published;
		}
		
		/**
		 * @return Realty
		**/
		public function setPublished(Timestamp $published = null)
		{
			$this->published = $published;
			
			return $this;
		}
		
		/**
		 * @return Realty
		**/
		public function dropPublished()
		{
			$this->published = null;
			
			return $this;
		}
		
		/**
		 * @return RealtyPicturesDAO
		**/
		public function getPictures($lazy = false)
		{
			if (!$this->pictures || ($this->pictures->isLazy() != $lazy)) {
				$this->pictures = new RealtyPicturesDAO($this, $lazy);
			}
			
			return $this->pictures;
		}
		
		/**
		 * @return Realty
		**/
		public function fillPictures($collection, $lazy = false)
		{
			$this->pictures = new RealtyPicturesDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->pictures->mergeList($collection);
			
			return $this;
		}
		
		/**
		 * @return RealtyFeaturesDAO
		**/
		public function getFeatures($lazy = false)
		{
			if (!$this->features || ($this->features->isLazy() != $lazy)) {
				$this->features = new RealtyFeaturesDAO($this, $lazy);
			}
			
			return $this->features;
		}
		
		/**
		 * @return Realty
		**/
		public function fillFeatures($collection, $lazy = false)
		{
			$this->features = new RealtyFeaturesDAO($this, $lazy);
			
			if (!$this->id) {
				throw new WrongStateException(
					'i do not know which object i belong to'
				);
			}
			
			$this->features->mergeList($collection);
			
			return $this;
		}
	}
?>