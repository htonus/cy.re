<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
final class controllerCity extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(City::create());

		$this->map->addSource('country', RequestType::get());
		$this->map->addSource('country', RequestType::post());
		$this->map->addSource('region', RequestType::get());
		$this->map->addSource('region', RequestType::post());
		
		$this->setMethodMapping('list', 'doList');
		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$country = $this->map->importOne('country', $request)->
			getForm()->
				getValue('country');

		if ($country)
			$request->setAttachedVar('country', $country);
		
		$region = $this->map->importOne('region', $request)->
			getForm()->
				getValue('region');
		
		if (
			$region
			&& $country
			&& $region->getCountryId() == $country->getId()
		)
			$request->setAttachedVar('region', $region);
		
		return parent::beforeHandle($request);
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$regionList = array();
		
		if ($request->hasAttachedVar('country')) {
			$country = $request->getAttachedVar('country');
		} else {
			$country = $this->getForm()->getValue('country');
		}
			
		if ($country) {
			$model->set('country', $country);
			
			if ($model->has('form'))
				$model->get('form')->setValue('country', $country);
			
			$regionList = Criteria::create(Region::dao())->
				add(
					Expression::eqId('country', $country)
				)->
				getList();
		}
		
		if ($request->hasAttachedVar('region')) {
			$model->set('region', $request->getAttachedVar('region'));
			
			if ($model->has('form'))
				$model->get('form')->
					setValue('region', $request->getAttachedVar('region'));
		}
		
		$model->set('countryList', Criteria::create(Country::dao())->getList());
		$model->set('regionList', $regionList);
		
		return parent::attachCollections($request, $model);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model)->
			dropOrder()->
			add(
				Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
			)->
			addOrder(
				OrderBy::create('i18n.name')->asc()
			);
		
		if ($request->hasAttachedVar('country'))
			$criteria->add(
				Expression::eqId('country', $request->getAttachedVar('country'))
			);
		
		if ($request->hasAttachedVar('region'))
			$criteria->add(
				Expression::eqId('region', $request->getAttachedVar('region'))
			);
		
		return $criteria;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area=city'
				.'&country='.(
					$request->hasAttachedVar('country')
						? $request->getAttachedVar('country')->getId()
						: null
				)
				.'&region='.(
					$request->hasAttachedVar('region')
						? $request->getAttachedVar('region')->getId()
						: null
				)
			)
		);
	}
	
	protected function doList(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::identifier('country')->of('Country')
			)->
			add(
				Primitive::identifier('region')->of('region')
			)->
			add(
				Primitive::identifier('city')->of('city')
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$regionList = $cityList = $districtList = array();
		$country = $form->getValue('country');
		$region = $form->getValue('region');
		$city = $form->getValue('city');
		
		switch (true) {
			case !empty($country):
				$regionList = CriteriaUtils::getSortedCriteria(Region::dao())->
					add(
						Expression::eqId('country', $country)
					)->
					getList();
				
				if (count($regionList) == 1)
					$region = reset($regionList);
				
			case !empty($region):
				$cityList = CriteriaUtils::getSortedCriteria(City::dao())->
					add(
						empty($region)
							? Expression::eqId('country', $country)
							: Expression::eqId('region', $region)
					)->
					getList();
				
				if (count($cityList) == 1)
					$city = reset($cityList);
				
			case !empty($city):
				if (!empty($city)) {
					$districtList = CriteriaUtils::getSortedCriteria(District::dao())->
						add(
							Expression::eqId('city', $city)
						)->
						getList();
				}
		}
		
		$regionList		= ArrayHelper::toNameList($regionList);
		$cityList		= ArrayHelper::toNameList($cityList);
		$districtList	= ArrayHelper::toNameList($districtList);
		
		
		return $this->sendJson(compact('regionList', 'cityList', 'districtList'));
	}
}
