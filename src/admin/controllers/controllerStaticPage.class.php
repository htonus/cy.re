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
			$request->setAttachedVar('type', $type);

		$section = $this->map->importOne('section', $request)->
			getForm()->
				getValue('section');

		if ($section)
			$request->setAttachedVar('section', $section);

		return parent::beforeHandle($request);
	}

	public function afterHandle(HttpRequest $request, ModelAndView $mav)
	{
		if (!$mav->viewIsRedirect()) {
			if ($request->hasAttachedVar('type'))
				$mav->getModel()->set('type', $request->getAttachedVar('type'));

			if ($request->hasAttachedVar('section'))
				$mav->getModel()->set('section', $request->getAttachedVar('section'));
		}

		parent::afterHandle($request, $mav);
	}

	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);

		if ($request->hasAttachedVar('type'))
			$criteria->add(
				Expression::eqId('type', $request->getAttachedVar('type'))
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

		if ($request->hasAttachedVar('type'))
			$model->set('type', $request->getAttachedVar('type'));

		if ($request->hasAttachedVar('section'))
			$model->set('section', $request->getAttachedVar('section'));

		return $this;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area='.lcfirst(get_class($this->subject))
				.'&type='.($request->hasAttachedVar('type') ? $request->getAttachedVar('type')->getId() : null)
				.'&section'.($request->hasAttachedVar('section') ? $request->getAttachedVar('section')->getId() : null)
			)
		);
	}
}
