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
		
		$this->setMethodMapping('list', 'doList');
		$this->setAccessMapping('list', Access::UPDATE);
	}
	
	protected function addObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$object = parent::addObject($request, $form, $object);
		
		if ($object->getId()) {
			foreach(ArrayHelper::buildTree($object->dao()->getPlainList()) as $item)
				$object->dao()->save($item);
		}
		
		return $object;
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

		// Category list tree-sorted
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

		// Artcle counts list
		$countList = Criteria::create(Article::dao())->
			setProjection(
				Projection::chain()->
					add(Projection::property('category', 'id'))->
					add(Projection::count('id', 'count'))->
					add(Projection::group('category'))
			)->
			getCustomList();
		$articleCountList = array();
		foreach ($countList as $row)
			$articleCountList[$row['id']] = $row['count'];
		$model->set('articleCountList', $articleCountList);
		
		return $this;
	}
}
