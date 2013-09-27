<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buy Controller
 *
 * @author htonus
 */
class controllerRead extends controllerMain
{
	const PER_PAGE	= 20;
	const LATEST	= 3;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->setMethodMapping('item', 'actionItem');
		$this->accessObject = Article::create();

		$this->setAccessRules(
			array(
				'index'		=> Access::LISTS,
				'item'		=> Access::READ,
			)
		);
		
		$this->section = Section::read();
	}
	
	public function actionIndex(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('slug')->addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('search')->addImportFilter(Filter::trim())
			)->
			import($request->getGet());
		
		$category = null;
		
		if ($slug = $form->getValue('slug')) {
			$list = $request->getAttachedVar('categoryList');

			foreach ($list as $item) {
				if (
					$item->getId() == $slug
					|| $item->getSlug() == $slug
				) {
					$category = $item;
					break;
				}
			}
		}
		
		$request->
			setAttachedVar('category', $category)->
			setAttachedVar('search', $form->getValue('search'));
		
		$mav = ModelAndView::create();
		
		// Only for top level
		if (!$category) {
			$criteria = Criteria::create(Article::dao())->
				add(
					Expression::notNull('published')
				)->
				setLimit(self::LATEST)->
				addOrder(
					OrderBy::create('published')->desc()
				);
			
			$mav->getModel()->set('latestList', $criteria->getList());
		}
		
		return $mav;
	}
	
	protected function actionItem(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of('Article')
			)->
			import($request->getGet());
		
		$mav = ModelAndView::create();
		
		if ($article = $form->getValue('id')) {
			$mav->getModel()->
				set('article', $article);
			
			$request->
				setAttachedVar('category', $article->getCategory())->
				setAttachedVar('search', null);
		} else {
			$mav->setView(
				RedirectView::create(PATH_WEB)
			);
		}
		
		return $mav;
	}
	
	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
		
		$criteria = Criteria::create(Article::dao())->
			add(
				Expression::notNull('published')
			)->
			addOrder(
				OrderBy::create('created')->desc()
			);
		
		if ($category = $request->getAttachedVar('category')) {
			$criteria->add(
				Expression::eqId('category', $category)
			);
		}
		
		if ($search = $request->getAttachedVar('search')) {
			$criteria->add(
				Expression::orBlock()->
				expOr(Expression::ilike('i18n.name', "%$search%"))->
				expOr(Expression::ilike('i18n.brief', "%$search%"))->
				expOr(Expression::ilike('i18n.text', "%$search%"))
			);
		}
		
		$mav->getModel()->
			set('category', $category)->
			set('search', $search);
		
		$request->setAttachedVar('criteria', $criteria);
		
		PagerHelper::create($request)->
			setPerPage(self::PER_PAGE)->
			doPage($mav->getModel());
		
		return parent::attachCollections($request, $mav);
	}
}
