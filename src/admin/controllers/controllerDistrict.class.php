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
		
		$this->map->addSource('city', RequestType::get());
		$this->map->addSource('city', RequestType::post());
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$city = $this->map->importOne('city', $request)->
			getForm()->
				getValue('city');
		
		if ($city)
			$request->setAttachedVar('city', $city);
		
		return parent::beforeHandle($request);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		if ($request->hasAttachedVar('city'))
			$criteria->add(
				Expression::eqId('city', $request->getAttachedVar('city'))
			);
		
		return $criteria;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set('cityList', Criteria::create(City::dao())->getList());
		
		if ($request->hasAttachedVar('city'))
			$model->set('city', $request->getAttachedVar('city'));
		
		return $this;
	}
}
