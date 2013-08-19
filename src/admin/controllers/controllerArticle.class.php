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
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set(
			'categoryList',
			Criteria::create(ArticleCategory::dao())->
				add(
					Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
				)->
				addOrder('i18n.name')->				
				getList()
		);
		
		if ($request->hasAttachedVar('parent'))
			$model->set('parent', $request->getAttachedVar('parent'));
		
		return $this;
	}
}
