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
final class controllerDistrict extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(District::create());
		
		$this->getForm()->
			add(
				Primitive::identifier('country')->
					of('Country')
			);
		
		$this->map->addSource('country', RequestType::get());
		$this->map->addSource('country', RequestType::post());
		$this->map->addSource('city', RequestType::get());
		$this->map->addSource('city', RequestType::post());
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$country = $this->map->importOne('country', $request)->
			getForm()->
				getValue('country');

		if ($country)
			$request->setAttachedVar('country', $country);
		
		$city = $this->map->importOne('city', $request)->
			getForm()->
				getValue('city');
		
		if (
			$city
			&& $city->getCountryId() == $city->getId()
		)
			$request->setAttachedVar('city', $city);
		
		return parent::beforeHandle($request);
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$cityList = array();
		
		if ($request->hasAttachedVar('country')) {
			$country = $request->getAttachedVar('country');
		} else {
			$country = $this->getForm()->getValue('country');
		}
			
		if ($country) {
			$model->set('country', $country);
			
			if ($model->has('form'))
				$model->get('form')->setValue('country', $country);
			
			$cityList = Criteria::create(City::dao())->
				add(
					Expression::eqId('country', $country)
				)->
				getList();
		}
		
		if ($request->hasAttachedVar('city')) {
			$model->set('city', $request->getAttachedVar('city'));
			
			if ($model->has('form'))
				$model->get('form')->
					setValue('city', $request->getAttachedVar('city'));
		}
		
		if ($request->getAttachedVar('action') != 'edit') {
			$model->set('countryList', Criteria::create(Country::dao())->getList());
			$model->set('cityList', $cityList);
		}
		
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
		
		if ($request->hasAttachedVar('city'))
			$criteria->add(
				Expression::eqId('city', $request->getAttachedVar('city'))
			);
		
		elseif ($request->hasAttachedVar('country'))
			$criteria->add(
				Expression::eqId('city.country', $request->getAttachedVar('country'))
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
				.'&city='.(
					$request->hasAttachedVar('city')
						? $request->getAttachedVar('city')->getId()
						: null
				)
			)
		);
	}	
}
