<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Articles management controller
 *
 * @author htonus
 */
final class controllerArticle extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(Article::create());

		$this->map->addSource('category', RequestType::get());
		$this->map->addSource('category', RequestType::post());
	}

	public function beforeHandle(HttpRequest $request)
	{
		$category = $this->map->importOne('category', $request)->
			getForm()->
				getValue('category');

		if ($category)
			$request->setAttachedVar('category', $category);

		return parent::beforeHandle($request);
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$list = Criteria::create(ArticleCategory::dao())->
			add(
				Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
			)->
			addOrder(
				OrderBy::create('i18n.name')->asc()
			)->
			getList();

		uasort($list, array($this, 'sortTree'));

		$model->set('categoryList', ArrayUtils::convertObjectList($list));
		
		if ($request->hasAttachedVar('category'))
			$model->set('category', $request->getAttachedVar('category'));
		
		return $this;
	}
}
