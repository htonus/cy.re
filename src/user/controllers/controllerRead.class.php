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
	const PER_PAGE = 20;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->setMethodMapping('item', 'actionItem');
		
		$this->section = Section::read();
	}
	
	public function actionIndex(HttpRequest $request)
	{
		$slug = Form::create()->
			add(
				Primitive::string('slug')->addImportFilter(Filter::trim())
			)->
			import($request->getGet())->
			getValue('slug');
		
		$category = null;
		
		if (!empty($slug)) {
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
		
		$model = Model::create()->set('category', $category);
		
		return ModelAndView::create()->setModel($model);
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
				set('category', $article->getCategory())->
				set('article', $article);
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
			addOrder(
				OrderBy::create('created')->desc()
			);
		
		if ($category = $mav->getModel()->get('category')) {
			$criteria->add(
				Expression::eqId('category', $category)
			);
		}
		
		$request->setAttachedVar('criteria', $criteria);
		
		PagerHelper::create($request)->
			setPerPage(self::PER_PAGE)->
			doPage($mav->getModel());
		
		return parent::attachCollections($request, $mav);
	}
}
