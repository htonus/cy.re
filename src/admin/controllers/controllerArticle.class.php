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
class controllerArticle extends i18nEditor
{
	/**
	 * @var ArticleType 
	 */
	protected $type = null;


	public function __construct()
	{
		parent::__construct(Article::create());
		
		$this->subject->setType($this->type);
		
		$this->getForm()->drop('type');
		
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

	public function saveObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$object = parent::saveObject($request, $form, $object);
		
		if (!$form->getErrors()) {
			$object->getSites()->
				fetch()->
				setList($form->getValue('sites'))->
				save();
		}

		return $object;
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
		$model->set('type', $this->type);
		
		if ($request->hasAttachedVar('category'))
			$model->set('category', $request->getAttachedVar('category'));
		
		return $this;
	}
	
	/**
	 * Returns base list criteria
	 * @param HttpRequest $request
	 * @param Model $model
	 * @return Criteria $criteria
	 */
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		$criteria->add(
			Expression::eqId('type', $this->type)
		);
		
		return $criteria;
	}
	

	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area='.$request->getAttachedVar('area')
			)
		);
	}	
}
