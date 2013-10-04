<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Static Pages management controller
 *
 * @author htonus
 */
final class controllerStaticPage extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(StaticPage::create());
		
		$this->map->addSource('type', RequestType::get());
		$this->map->addSource('type', RequestType::post());
		
		$this->map->addSource('section', RequestType::get());
		$this->map->addSource('section', RequestType::post());

		$this->setMethodMapping('list', 'doList');
		$this->setMethodMapping('searchRealty', 'doSearch');

		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$type = $this->map->importOne('type', $request)->
			getForm()->
				getValue('type');

		if ($type)
			$request->setAttachedVar('staticType', $type);

		$section = $this->map->importOne('section', $request)->
			getForm()->
				getValue('section');

		if ($section)
			$request->setAttachedVar('section', $section);

		return parent::beforeHandle($request);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);

		if ($request->hasAttachedVar('staticType'))
			$criteria->add(
				Expression::eqId('type', $request->getAttachedVar('staticType'))
			);

		if ($request->hasAttachedVar('section'))
			$criteria->add(
				Expression::eqId('section', $request->getAttachedVar('section'))
			);

		return $criteria;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);

		$model->set('staticTypeList', StaticType::about()->getObjectList());

		$model->set('sectionList', Section::buy()->getObjectList());

		if ($request->hasAttachedVar('staticType'))
			$model->set('staticType', $request->getAttachedVar('staticType'));

		if ($request->hasAttachedVar('section'))
			$model->set('section', $request->getAttachedVar('section'));

		return $this;
	}
}
