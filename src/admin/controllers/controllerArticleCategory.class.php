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
final class controllerArticleCategory extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(ArticleCategory::create());
		
		$this->map->addSource('parent', RequestType::get());
		$this->map->addSource('parent', RequestType::post());
		
		$this->setMethodMapping('list', 'doList');
		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	public function beforeHandle(HttpRequest $request)
	{
		$city = $this->map->importOne('parent', $request)->
			getForm()->
				getValue('parent');
		
		if ($city)
			$request->setAttachedVar('parent', $city);
		
		return parent::beforeHandle($request);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		if ($request->hasAttachedVar('parent'))
			$criteria->add(
				Expression::eqId('parent', $request->getAttachedVar('parent'))
			);
		
		return $criteria;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set(
			'topList',
			Criteria::create(ArticleCategory::dao())->
				add(Expression::isNull('parent'))->
				getList()
		);
		
		if ($request->hasAttachedVar('parent'))
			$model->set('parent', $request->getAttachedVar('parent'));
		
		return $this;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area=articleCategory&parent='
				.(
					$request->hasAttachedVar('parent')
						? $request->getAttachedVar('parent')->getId()
						: null
				)
			)
		);
	}
}
