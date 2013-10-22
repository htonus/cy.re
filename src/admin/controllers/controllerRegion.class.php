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
final class controllerRegion extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(Region::create());
		
		$this->map->addSource('country', RequestType::get());
		$this->map->addSource('country', RequestType::post());
		
		$this->setMethodMapping('list', 'doList');
		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$city = $this->map->importOne('country', $request)->
			getForm()->
				getValue('country');
		
		if ($city)
			$request->setAttachedVar('country', $city);
		
		return parent::beforeHandle($request);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		if ($request->hasAttachedVar('country'))
			$criteria->add(
				Expression::eqId('country', $request->getAttachedVar('country'))
			);
		
		return $criteria;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set('countryList', Criteria::create(Country::dao())->getList());
		
		if ($request->hasAttachedVar('country'))
			$model->set('country', $request->getAttachedVar('country'));
		
		return $this;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area=region&country='
				.(
					$request->hasAttachedVar('country')
						? $request->getAttachedVar('country')->getId()
						: null
				)
			)
		);
	}
	
	protected function doList(HttpRequest $request)
	{
		$list = array();
		
		if ($request->hasAttachedVar('country')) {
			$list = District::dao()->
				getByCity($request->getAttachedVar('country'), true);
		}
		
		return $this->sendJson(array('regionList' => $list));
	}
}
