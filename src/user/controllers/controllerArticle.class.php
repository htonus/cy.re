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
class controllerArticle extends controllerMain
{
	const PER_PAGE	= 20;
	const LATEST	= 3;
	
	/**
	 * @var ArticleType 
	 */
	protected $type = null;
	
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
		
		$this->historyName = 'history.article.'.$this->type->getId();
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
			$mav->getModel()->set('latestList', $this->getLatestList());
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
			add(
				Expression::eqId('type', $this->type)
			)->
			addOrder(
				OrderBy::create('created')->desc()
			);
		
		if ($category = $request->getAttachedVar('category')) {
			$criteria->add(
				Expression::eqId('category', $category)
			);
			
			$mav->getModel()->set('category', $category);
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
			set('search', $search)->
			set('section', $this->section);
		
		$request->setAttachedVar('criteria', $criteria);
		
		PagerHelper::create($request)->
			setPerPage(self::PER_PAGE)->
			doPage($mav->getModel());
		
		return parent::attachCollections($request, $mav);
	}

	protected function getLatestList()
	{
		$list = Criteria::create(Article::dao())->
			add(
				Expression::notNull('published')
			)->
			add(
				Expression::isFalse('promote')
			)->
			addOrder(
				OrderBy::create('created')->desc()
			)->
			setLimit(self::LATEST)->
			getList();

		return $list;
	}
}
