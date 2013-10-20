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
final class controllerFeatureType extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(FeatureType::create());

		$this->map->addSource('group', RequestType::get());
		$this->map->addSource('group', RequestType::post());
		
		$this->setMethodMapping('list', 'doList');
		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$group = $this->map->importOne('group', $request)->
			getForm()->
				getValue('group');

		if ($group)
			$request->setAttachedVar('group', $group);

		return parent::beforeHandle($request);
	}

	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model)->
			add(
				Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
			)->
			addOrder(
				OrderBy::create('i18n.name')->asc()
			);
		
		if ($request->hasAttachedVar('group'))
			$criteria->add(
				Expression::eqId('group', $request->getAttachedVar('group'))
			);
		
		return $criteria;
	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set(
			'unitList',
			Unit::dao()->getPlainList()
		);
		
		$model->set(
			'groupList',
			FeatureTypeGroup::getAnyObject()->getObjectList()
		);
		
		if ($request->hasAttachedVar('group')) {
			$model->set('group', $request->getAttachedVar('group'));
			
			if ($model->has('form'))
				$model->get('form')->
					setValue('group', $request->getAttachedVar('group'));
		}

		return $this;
	}

	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area=featureType&group='
				.(
					$request->hasAttachedVar('group')
						? $request->getAttachedVar('group')->getId()
						: null
				)
			)
		);
	}

	protected function doList(HttpRequest $request)
	{
		$list = array();

		if ($request->hasAttachedVar('group')) {
			$list = FeatureType::dao()->
				getByCity($request->getAttachedVar('group'), true);
		}

		return $this->sendJson(array('featureTypeList' => $list));	}
}
